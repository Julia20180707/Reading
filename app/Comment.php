<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    //
    //黑名单
    protected $guarded = ['id'];
    //反向关联user数据模型
    public function user()
    {
        return $this->belongsTo('App\User','user_id','id');
    }

    //建立与赞的关联
    public function zan($comment_id,$user_id)
    {
        //建立 一对一 关联赞表
        return $this->hasOne('\App\Comment_good')->where('comment_id','=',$comment_id)->where('user_id','=',$user_id);

    }

    //统计点赞数量
    public function zans()
    {
        return $this->hasMany('App\Comment_good');
    }
}
