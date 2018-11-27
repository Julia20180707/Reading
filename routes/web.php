<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});



Route::prefix("/")->namespace("Home")->group(function () {


    //用户注册
    Route::get("register", "RegisterController@index");//加载注册页面
    Route::post("register", "RegisterController@register");//执行注册

    //用户登录
    Route::get("login", "LoginController@index");//加载登录页面
    Route::post("login", "LoginController@login");//执行登录
    Route::get("logout", "LoginController@logout");//执行退出

    Route::get("index", "BookController@index");//首页
    Route::get("author", "BookController@author");//作者信息
    Route::get("classify", "BookController@classify");//分类页面
    Route::get("book_detail", "BookController@book_detail");//书籍详情
    Route::get("author_detail", "BookController@author_detail");//作者详情



    Route::get("mine", "UserController@index");//个人主页
    Route::get("setting", "UserController@setting")->middleware('auth');//个人信息设置
    Route::post("save_setting", "UserController@save_setting")->middleware('auth');//修改保存
});

//    Route::get("index", "BookController@index");
//    Route::get("author", "BookController@author");
//    Route::get("mine", "BookController@mine");
//});


//后台路由组
Route::prefix("admin")->namespace("Admin")->group(function () {
    /* 后台首页开始 */
    Route::get("index", "BookController@index");
    /* 后台首页结束 */

    /* 分类管理模块开始 */
    Route::get("classify", "BookController@classify");
    Route::get("classify_delete/{id}", "BookController@classify_delete");
    Route::post("classify_add", "BookController@classify_add");
    Route::get("classify_edit/{id}", "BookController@classify_edit");
    Route::post("classify_save", "BookController@classify_save");
    /* 分类管理模块结束 */

    /* 书籍管理模块开始 */
    Route::get("upload", "BookController@upload");
    Route::post("books_upload", "BookController@books_upload");
    /* 书籍管理模块结束 */
});

