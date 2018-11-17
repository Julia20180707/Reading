<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCollectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('collects', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('book_id')->comment('外键：所评论的书籍id');
            $table->unsignedInteger('user_id')->comment('外键：用户id');
            $table->unsignedInteger('comment_id')->comment('外键：评论id');
            $table->unsignedInteger('origin_user')->comment('外键：写评论的用户id');
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
        Schema::dropIfExists('collects');
    }
}
