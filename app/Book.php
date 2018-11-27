<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    //黑名单
    protected $guarded = ['id'];
}
