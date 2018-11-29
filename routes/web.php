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
    return view('/home/index');
});



Route::prefix("/")->namespace("Home")->group(function () {


    //用户注册
    Route::get("register", "RegisterController@index");//加载注册页面
    Route::post("register", "RegisterController@register");//执行注册

    //用户登录
    Route::get("login", "LoginController@index");//加载登录页面
    Route::post("login", "LoginController@login");//执行登录
//    Route::post("dologin/{val}", "LoginController@dologin");//执行登录
    Route::get("logout", "LoginController@logout");//执行退出

    Route::get("index", "BookController@index");//首页
    Route::get("author", "BookController@author");//作者信息
    Route::get("classify/{id?}", "BookController@classify");//分类页面
    Route::get("book_detail/{id}", "BookController@book_detail");//书籍详情
    Route::get("catalog/{book_id}", "BookController@catalog");//书籍目录页面
    Route::get("read/{directory}/{chapter_name}", "BookController@read");//读书页面




    Route::get("bookcase", "BookController@bookcase");//书架
    Route::get("collect", "BookController@collect");//收藏

    Route::get("author/{id}", "BookController@author");//作者信息
    Route::get("fan", "UserController@fan");//关注作者信息
    Route::get("un_fan/{id}", "UserController@un_fan");//取消关注作者信息
    Route::get("/add_like_author/{id}", "UserController@add_like_author");//作者添加到收藏

    Route::get("classify", "BookController@classify");//分类页面


    Route::get("book_detail/{id}", "BookController@book_detail");//书籍详情
    Route::get("author_detail", "BookController@author_detail");//作者详情
    Route::get("/book/{id}/zan", "BookController@zan");//书籍点赞
    Route::get("/book/{id}/unzan", "BookController@unzan");//书籍取消赞
    Route::post("/book_comment/{id}", "BookController@book_comment");//书籍评论
    Route::get("/comment/{model}/zan", "CommentController@zan");//书籍评论点赞
    Route::get("/comment/{id}/unzan", "CommentController@unzan");//书籍评论取消赞

    Route::get("/add_book/{id}", "BookController@add_book");//书籍添加到书架
    Route::get("/remove_book/{id}", "BookController@remove_book");//移除书架

    Route::get("/add_like_book/{id}", "BookController@add_like_book");//书籍添加到收藏
    Route::get("/un_like_book/{id}", "BookController@un_like_book");//取消收藏




    Route::get("mine", "UserController@index");//个人主页
    Route::get("setting", "UserController@setting")->middleware('auth');//个人信息设置
    Route::post("save_setting", "UserController@save_setting")->middleware('auth');//修改保存
});


//后台路由组
Route::prefix("admin")->namespace("Admin")->group(function () {

    /*用户登录*/
    Route::get("login", "UserController@login");
    Route::post("dologin", "UserController@dologin");
    Route::get("logout", "UserController@logout");


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