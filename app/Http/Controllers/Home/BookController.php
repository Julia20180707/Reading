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
    //个人信息
    public function mine()
    {
        return view("home/mine");
    }
}
