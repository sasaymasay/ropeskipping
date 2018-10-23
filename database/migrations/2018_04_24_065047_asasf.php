<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Asasf extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('scores', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned()->default(1);
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->integer('judge_id1')->unsigned()->default(1);
            $table->foreign('judge_id1')->references('id')->on('judges')->onDelete('cascade')->onUpdate('cascade');
            $table->float('score_j1')->default(0);
            $table->integer('judge_id2')->unsigned()->default(1);
            $table->foreign('judge_id2')->references('id')->on('judges')->onDelete('cascade')->onUpdate('cascade');
            $table->float('score_j2')->default(0);
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
        Schema::drop('scores');
    }
}
