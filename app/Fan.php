<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Fan extends Model
{
    //
    //黑名单
    protected $guarded = ['id'];


    //建立与作者的关联
    public function author()
    {
        //建立（一对多）的反向关联用户表
        return $this->belongsTo('\App\Author','star_id','id');

    }
}
