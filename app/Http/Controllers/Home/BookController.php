<?php

namespace App\Http\Controllers\Home;

use App\Book;
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
        return view("home/index");
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
    public function classify(){
        return  view("home/classify");
    }
    //书籍详情
    public function book_detail($id){

        //查询当前书籍信息
        $book=Book::where('id',$id)->withCount('zans','comments')->get()[0];

        $comments=$book->comment()->orderBy("updated_at", "desc")->withCount('zans')->get();


        return  view("home/book_detail",compact('book','comments'));
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
    public function book_comment(Request $request,$book_id){

        $date=[
            'user_id'=>\Auth::id(),
            'book_id'=>$book_id,
            'content'=>$request['content'],
        ];
//dd($date);

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
    public function bookcase(){

        $books=Bookcase::where('user_id','=',\Auth::id())->get();

        return view('/home/bookcase',compact('books'));

    }

    //查看用户收藏
    public function collect(){

        $books=Collect::where('user_id','=',\Auth::id())->get();

        return view('/home/collect',compact('books'));

    }
}
