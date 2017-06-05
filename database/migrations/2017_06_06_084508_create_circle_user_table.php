<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCircleUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('circle_user', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned()->index();
            $table->integer('circle_id')->unsigned()->index();
            $table->integer('state');
            $table->timestamps();

            // 外部キー設定
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('circle_id')->references('id')->on('circles');

            // user_idとcircle_idの組み合わせの重複を許さない
            $table->unique(['user_id', 'circle_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('circle_user');
    }
}
