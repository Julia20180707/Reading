<?php

namespace App\Http\Controllers\Home;

use App\Book;
use App\Chapter;
use App\Classify;
use App\Book_good;
use App\Bookcase;
use App\Collect;
use App\Comment;
use App\Author;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BookController extends Controller
{
    //首页
    public function index()
    {
        //附近热门
        $hot_books = Book::withCount('book_goods')->get()->sortByDesc('book_goods_count')->take(5);
        //高分榜
        $score_books = Book::withCount('book_goods')->get()->sortByDesc('book_goods_count')->take(3);
        //灯幕热门(暂放数据库books表中前十本)
        $all_books = Book::take(10)->get();
        //新书榜
        $new_books = Book::orderBy('created_at', 'desc')->take(3)->get();
        //总榜(暂按收藏排行)
        $good_books = Book::withCount('all_collects')->get()->sortByDesc('all_collects_count')->take(3);
        return view("home/index", compact('hot_books', 'all_books', 'score_books', 'new_books', 'good_books'));
    }

    //作者信息
    public function author($id)
    {
        //获取当前作者信息
        $author=Author::find($id);

        //获取当前作者的书
        $books=Book::where('author_id',$id)->get();

        $comments=$books[0]->comment()->take(2)->get();

        return view("home/author",compact('author','books','comments'));
    }

    //分类
    public function classify($id=11)
    {
        $classifies = Classify::get();

        $books = Book::where('class_id', $id)->withCount('book_goods')->get()->sortByDesc('book_goods_count');

        return  view("home/classify", compact('classifies', 'books'));
    }

    //作者详情
    public function author_detail()
    {
        return view('/home/author');
    }

    public function book_detail($id)
    {
        //查询当前书籍信息
        $book=Book::where('id',$id)->withCount('zans','comments')->get()[0];

        $chapter_name = Chapter::where('book_id', $id)->where('chapter_id', 1)->get()[0]->chapter_name;

        $comments=$book->comment()->orderBy("updated_at", "desc")->withCount('zans')->get();

        return  view("home/book_detail",compact('book','comments', 'chapter_name'));
    }

    public function zan($id)
    {
        //获取帖子id和用户id
        $data=[
            'book_id'=>$id,
            'user_id'=>\Auth::id(),
        ];

        //存储到模型中(firstOrCreate:代表数据表中没有就添加，有就查询)
        Book_good::firstOrCreate($data);

        //渲染
        return back()->with('success','点赞成功');

    }

    /*
     * unzan the post article
     * */
    public function unzan($id)
    {
        $book = Book::find($id);

        //取消赞，就是删除指定书籍id的指定用户id的信息
        $book->zan(\Auth::id())->delete();

        //渲染
        return back()->with('success','取消赞成功');
    }

    //发布书籍评论
    public function book_comment(Request $request,$book_id)
    {
        if (!\Auth::check()) {
            return redirect("/login");
        }

        $date=[
            'user_id'=>\Auth::id(),
            'book_id'=>$book_id,
            'content'=>$request['content'],
        ];

        //将数据存入评论表
        Comment::create($date);

        return back();

    }


    //书籍添加到书架
    public function add_book($id){

        $date=[
          'user_id'=>\Auth::id(),
          'book_id'=>$id,
        ];
        Bookcase::create($date);

        return back();

    }

    public function remove_book($id)
    {
        $book = Book::find($id);

        //取消赞，就是删除指定书籍id的指定用户id的信息
        $book->bookcase(\Auth::id())->delete();

        //渲染
        return back();
    }

    public function un_like_book($id)
    {
        $book = Book::find($id);

        //取消赞，就是删除指定书籍id的指定用户id的信息
        $book->collect(\Auth::id())->delete();

        //渲染
        return back();
    }

    //书籍添加到收藏
    public function add_like_book($id){


        $date=[
            'user_id'=>\Auth::id(),
            'book_id'=>$id,
        ];

        Collect::create($date);

        return back();
    }

    //查看用户书架
    public function bookcase()
    {
        $books=Bookcase::where('user_id','=',\Auth::id())->get();
        return view('/home/bookcase',compact('books'));
    }

    //查看用户收藏
    public function collect(){

        $books=Collect::where('user_id','=',\Auth::id())->get();

        return view('/home/collect',compact('books'));
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
        if (!\Auth::check()) {
            return redirect("/login");
        }

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

        $chapters = Chapter::where("book_id", $book->id)->orderBy('chapter_id')->get();

        //当前章节号
        $chapter = Chapter::where(['book_id' => $book->id, 'chapter_name' => $chapter_name])->get()[0]->chapter_id;

        if (!count(Chapter::where(['book_id' => $book->id, 'chapter_id' => $chapter-1])->get())) {
            //若没有上一章  则只传出下一章chapter_name
            $chapter_name_next = Chapter::where('book_id', $book->id)->where('chapter_id', $chapter+1)->get()[0]->chapter_name;
            return view('/home/read', compact('chapters', 'directory', 'contents', 'chapter_name_next'));
        }

        if (!count(Chapter::where(['book_id' => $book->id, 'chapter_id' => $chapter+1])->get())) {
            //若没有下一章  则只传出上一章chapter_name
            $chapter_name_prev = Chapter::where('book_id', $book->id)->where('chapter_id', $chapter-1)->get()[0]->chapter_name;
            return view('/home/read', compact('chapters', 'directory', 'contents', 'chapter_name_prev'));
        }

        //下一章chapter_name
        $chapter_name_next = Chapter::where('book_id', $book->id)->where('chapter_id', $chapter+1)->get()[0]->chapter_name;
        //上一章chapter_name
        $chapter_name_prev = Chapter::where('book_id', $book->id)->where('chapter_id', $chapter-1)->get()[0]->chapter_name;

        return view('/home/read', compact('chapters', 'directory', 'contents', 'chapter_name_next', 'chapter_name_prev'));
    }

}
