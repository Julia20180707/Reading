<?php

namespace App\Http\Controllers\home;

use App\Comment;
use App\Comment_good;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CommentController extends Controller
{
    //
    public function zan($model)
    {
        $model=explode(',',$model);

        $book_id=$model[1];
        $comment_id=$model[0];

        //获取帖子id和用户id
        $data=[
            'book_id'=>$book_id,
            'comment_id'=>$comment_id,
            'user_id'=>\Auth::id(),
        ];


        //存储到模型中(firstOrCreate:代表数据表中没有就添加，有就查询)
        Comment_good::firstOrCreate($data);

        //渲染
        return back();

    }

    /*
     * unzan the post article
     * */
    public function unzan($id)
    {

        Comment_good::where('user_id',\Auth::id())->where('comment_id',$id)->delete();

        //渲染
        return back();
    }


    //
}
