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

    //书籍分类页面
    Route::get("popular", "BookController@popular");//热门
    Route::get("recommend", "BookController@recommend");//推荐
    Route::get("ranking", "BookController@ranking");//排行


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



/*用户登录*/
Route::get("/admin/login", "Admin\UserController@login");
Route::post("/admin/dologin", "Admin\UserController@dologin");
Route::get("/admin/logout", "Admin\UserController@logout");

//后台路由组
Route::prefix("admin")->namespace("Admin")->group(function () {



    /* 后台首页开始 */
    Route::get("index", "BookController@index")->middleware('CheckAuth');
    /* 后台首页结束 */

    /* 分类管理模块开始 */
    Route::get("classify", "BookController@classify")->middleware('CheckAuth');
    Route::get("classify_delete/{id}", "BookController@classify_delete")->middleware('CheckAuth');
    Route::post("classify_add", "BookController@classify_add")->middleware('CheckAuth');
    Route::get("classify_edit/{id}", "BookController@classify_edit")->middleware('CheckAuth');
    Route::post("classify_save", "BookController@classify_save")->middleware('CheckAuth');
    /* 分类管理模块结束 */

    /* 书籍管理模块开始 */
    Route::get("upload", "BookController@upload")->middleware('CheckAuth');
    Route::post("books_upload", "BookController@books_upload")->middleware('CheckAuth');

    Route::get("classify", "BookController@classify")->middleware('CheckAuth');  //加载分类页面
    Route::get("classify_delete/{id}", "BookController@classify_delete")->middleware('CheckAuth');   //删除某分类
    Route::post("classify_add", "BookController@classify_add")->middleware('CheckAuth');     //添加分类
    Route::get("classify_edit/{id}", "BookController@classify_edit")->middleware('CheckAuth');   //编辑分类
    Route::post("classify_save", "BookController@classify_save")->middleware('CheckAuth');   //保存修改后的分类
    /* 分类管理模块结束 */

    /* 书籍管理模块开始 */
    Route::get("upload", "BookController@upload")->middleware('CheckAuth');      //加载上传书籍页面
    Route::post("books_upload", "BookController@books_upload")->middleware('CheckAuth');     //执行书籍上传
    Route::get("books_manage", "BookController@books_manage")->middleware('CheckAuth');     //加载书籍管理页面
    Route::get("book_edit/{id}", "BookController@book_edit")->middleware('CheckAuth');     //加载修改书籍信息页面
    Route::post("book_save", "BookController@book_save")->middleware('CheckAuth');     //保存书籍信息修改
    Route::get("upload_chapter", "BookController@upload_chapter")->middleware('CheckAuth');     //加载上传章节页面
    Route::post("chapter_save", "BookController@chapter_save")->middleware('CheckAuth');     //执行章节上传
    /* 书籍管理模块结束 */
});