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
            $table->string('name', 50)->unique();
            $table->string('email', 50)->unique();
            $table->string('avatar');
            $table->tinyInteger('sex')->default(1)->commen('0为女，1为男');
            $table->string('password', 60);
            $table->integer('login_count')->default(0)->comment('登录次数');
            $table->string('active_token')->comment('邮箱激活的token');
            $table->tinyInteger('is_active')->default(0)->comment('用户是否激活');
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
