<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Chapter extends Model
{
    //黑名单
    protected $guarded = ['id'];
}
