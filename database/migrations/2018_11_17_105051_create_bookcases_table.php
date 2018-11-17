<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBookcasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bookcases', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('book_id')->comment('外键：关联书籍id');
            $table->unsignedInteger('state')->default(1)->comment('书籍状态(1为公开书籍，2为私密书籍)');
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
        Schema::dropIfExists('bookcases');
    }
}
