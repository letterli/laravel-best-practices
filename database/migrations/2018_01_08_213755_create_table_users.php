<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableUsers extends Migration
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
            $table->string('username', 32)->unique()->comment('用户名');
            $table->string('email', 32)->unique()->comment('邮箱');
            $table->string('password')->comment('密码');
            $table->integer('status')->default(0)->comment('用户状态 0:禁用 1:启用');
            $table->string('last_login_ip')->nullable()->comment('最后登录IP地址');
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
