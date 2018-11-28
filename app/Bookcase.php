<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bookcase extends Model
{
    //
    //黑名单
    protected $guarded = ['id'];


    //关联书
    public function book()
    {
        return $this->hasOne('\App\Book','id','book_id');

    }

}
