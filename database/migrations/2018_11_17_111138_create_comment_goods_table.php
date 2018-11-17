<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommentGoodsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comment_goods', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('book_id')->comment('外键：所评论的书籍id');
            $table->unsignedInteger('user_id')->comment('外键：关联用户id');
            $table->unsignedInteger('comment_id')->comment('外键：关联评论id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('comment_goods');
    }
}
