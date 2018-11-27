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

//Route::prefix("/")->namespace("Home")->group(function ()
Route::prefix("/")->namespace("Home")->group(function () {
    Route::get("index", "BookController@index");
    Route::get("author", "BookController@author");
    Route::get("mine", "BookController@mine");
});


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