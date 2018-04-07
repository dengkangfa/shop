<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSocialiteToUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->integer('github_id')->nullable()->index()->comment('github第三方登录的ID');
            $table->string('github_name')->nullable()->comment('github第三方登录的用户名');
            $table->string('qq_id')->nullable()->index();
            $table->string('qq_name')->nullable();
            $table->string('weibo_id')->nullable()->index();
            $table->string('weibo_name')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('github_id');
            $table->dropColumn('github_name');
            $table->dropColumn('qq_id');
            $table->dropColumn('qq_name');
            $table->dropColumn('weibo_id');
            $table->dropColumn('weibo_name');
        });
    }
}
