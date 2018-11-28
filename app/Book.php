<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    //黑名单
    protected $guarded = ['id'];

    //建立与用户的关联
    public function author()
    {
        //建立多对一的反向关联
        return $this->belongsTo("\App\User", "author_id", "id");
    }

    //统计点赞的数量
    public function book_goods()
    {
        return $this->hasMany('App\Book_good', 'book_id', 'id');
    }
}
