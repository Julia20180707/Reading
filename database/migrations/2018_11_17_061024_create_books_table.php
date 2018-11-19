<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('books', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title')->comment("书名");
            $table->unsignedInteger('author_id')->comment("外键：关联作者id");
            $table->unsignedInteger('class_id')->comment("外键：关联分类id");
            $table->string('description')->default('')->comment("书籍简介");
            $table->text('book_info')->comment("作品信息");
            $table->text('directory')->comment("书籍文件夹(随机字符串)");
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
        Schema::dropIfExists('books');
    }
}
