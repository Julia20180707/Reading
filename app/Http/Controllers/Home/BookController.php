<?php

namespace App\Http\Controllers\Home;

use App\Book;
use App\Chapter;
use App\Classify;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BookController extends Controller
{
    //首页
    public function index()
    {
        $books = Book::withCount('book_goods')->get()->sortByDesc('book_goods_count')->take(5);

        return view("home/index", compact('books'));
    }

    //作者信息
    public function author()
    {
        return view("home/author");
    }

    //分类
    public function classify($id=11)
    {
        $classifies = Classify::get();

        $books = Book::where('class_id', $id)->withCount('book_goods')->get()->sortByDesc('book_goods_count');

        return  view("home/classify", compact('classifies', 'books'));
    }

    //书籍详情
    public function book_detail($id)
    {

        return  view("home/book_detail");
    }

    //作者详情
    public function author_detail()
    {
        return view('/home/author');
    }

    //目录页面
    public function catalog($book_id)
    {
        $directory = Book::find($book_id)->directory;
        $chapters = Chapter::where("book_id", $book_id)->get();
        $contents = $this->read($book_id, 1);
        $contents = str_replace("<br/>","\n",$contents);
        return view('/home/read', compact('chapters', 'directory', 'contents'));
    }

    //读书页面
    public function read($directory, $chapter_name)
    {
        $book = Book::where('directory', $directory)->get()[0];
        //章节相对路径
        $path = 'books/' . $book->directory . '/' . $book->title . '/' . $chapter_name . '.txt';
        $handle= fopen(iconv ( 'UTF-8', 'GB2312', $path),"r");
        //指定读取大小，把整个文件内容读取出来
        $contents= fread($handle,filesize(iconv ( 'UTF-8', 'GB2312', $path)));
        fclose($handle);
        //匹配文件编码格式
        $encoding = mb_detect_encoding($contents, array('GB2312','GBK','UTF-16','UCS-2','UTF-8','BIG5','ASCII'));
        //转换格式
        $contents = iconv($encoding, 'UTF-8', $contents);
        $contents = str_replace("\r\n","\n",$contents);
//        return $contents;
        $chapters = Chapter::where("book_id", $book->id)->get();

        $chapter = Chapter::where(['book_id' => $book->id, 'chapter_name' => $chapter_name])->get()[0]->id;
        //下一章chapter_name
        $chapter_name_next = Chapter::where('chapter_id', $chapter+1)->get()[0]->chapter_name;
        //上一章chapter_name
        $chapter_name_prev = Chapter::where('chapter_id', $chapter-1)->get()[0]->chapter_name;
        return view('/home/read', compact('chapters', 'directory', 'contents', 'chapter_name_next', 'chapter_name_prev'));
    }

}
