<?php

namespace App\Http\Controllers\Home;

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
    public function author()
    {
        return view("home/author");
    }
    //分类
    public function classify(){
        return  view("home/classify");
    }
    //书籍详情
    public function book_detail(){
        return  view("home/book_detail");
    }

    //作者详情
    public function author_detail(){
        return view('/home/author');
    }
}
