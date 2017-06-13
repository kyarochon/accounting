<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCirclePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('circle_payments', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('circle_id')->unsigned()->index();
            $table->integer('type');
            $table->integer('category');
            $table->string('text');
            $table->integer('payments');
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
        Schema::drop('circle_payments');
    }
}
