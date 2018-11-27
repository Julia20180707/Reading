<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('authority')->default(1)->comment('用户权限');
            $table->string('name')->unique()->comment("用户名");
            $table->date('birthday')->default('2018-11-26')->comment("生日");
            $table->unsignedInteger('sex')->default(3)->comment("性别");
            $table->string('email')->unique()->comment("邮箱");
            $table->string('password')->comment("密码");
            $table->string('duration')->default(0)->comment("读书时长");
            $table->string('photo',255)->default('');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
