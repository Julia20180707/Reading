<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Chapter extends Model
{
    //黑名单
    protected $guarded = ['id'];

    //建立与书籍的关联
    public function book()
    {
        //建立多对一的反向关联
        return $this->belongsTo("\App\Book", "book_id", "id");
    }
}
