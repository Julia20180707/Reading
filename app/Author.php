<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    //
    //黑名单
    protected $guarded = ['id'];


    //建立与关注的关联
    public function fan($user_id,$star_id)
    {
        //建立 一对一 关联赞表
        return $this->hasOne('\App\Fan','star_id','id')->where('fan_id','=',$user_id)->where('star_id','=',$star_id);

    }



}
