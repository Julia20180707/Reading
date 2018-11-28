<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    //黑名单
    protected $guarded = ['id'];


    //建立与作者的关联
    public function author()
    {
        //建立（一对多）的反向关联用户表
        return $this->belongsTo('\App\Author','author_id','id');

    }

    //建立与赞的关联
    public function zan($user_id)
    {
        //建立 一对一 关联赞表
        return $this->hasOne('\App\Book_good')->where('user_id','=',$user_id);

    }

    //统计点赞数量
    public function zans()
    {
        return $this->hasMany('App\Book_good');
    }

    //关联评价表(一对多)
    public function comment()
    {
        //建立一对多的正向关联
        return $this->hasMany('App\Comment', 'book_id', 'id')->orderBy('created_at', 'desc');
    }


    //统计评论的数量
    public function comments()
    {
        //建立一对多的正向关联
        return $this->hasMany('App\Comment','book_id','id');
    }

    //与书架关联
    public function bookcase($user_id)
    {
        //建立一对多的正向关联
        return $this->hasMany('App\Bookcase', 'book_id', 'id')->where('user_id','=',$user_id);
    }

    //与收藏夹关联
    public function collect($user_id)
    {
        //建立一对多的正向关联
        return $this->hasMany('App\Collect', 'book_id', 'id')->where('user_id','=',$user_id);
    }
}
