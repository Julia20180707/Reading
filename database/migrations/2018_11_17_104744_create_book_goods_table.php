<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBookGoodsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('book_goods', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('book_id')->comment('外键：关联书籍id');
            $table->unsignedInteger('user_id')->comment('外键：关联用户id');
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
        Schema::dropIfExists('book_goods');
    }
}
