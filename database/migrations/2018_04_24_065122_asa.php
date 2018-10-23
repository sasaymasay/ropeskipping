<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Asa extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('freescores', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned()->default(1);
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->integer('judge_idsp1')->unsigned()->default(1);
            $table->foreign('judge_idsp1')->references('id')->on('judges')->onDelete('cascade')->onUpdate('cascade');
            $table->float('sloz1')->default(0);
            $table->float('plot1')->default(0);
            $table->integer('judge_idsp2')->unsigned()->default(1);
            $table->foreign('judge_idsp2')->references('id')->on('judges')->onDelete('cascade')->onUpdate('cascade');
            $table->float('sloz2')->default(0);
            $table->float('plot2')->default(0);
            $table->integer('judge_idsp3')->unsigned()->default(1);
            $table->foreign('judge_idsp3')->references('id')->on('judges')->onDelete('cascade')->onUpdate('cascade');
            $table->float('sloz3')->default(0);
            $table->float('plot3')->default(0);
            $table->integer('judge_idtz1')->unsigned()->default(1);
            $table->foreign('judge_idtz1')->references('id')->on('judges')->onDelete('cascade')->onUpdate('cascade');
            $table->float('tech1')->default(0);
            $table->float('zrel1')->default(0);
            $table->integer('judge_idtz2')->unsigned()->default(1);
            $table->foreign('judge_idtz2')->references('id')->on('judges')->onDelete('cascade')->onUpdate('cascade');
            $table->float('tech2')->default(0);
            $table->float('zrel2')->default(0);
            $table->integer('judge_idtz3')->unsigned()->default(1);
            $table->foreign('judge_idtz3')->references('id')->on('judges')->onDelete('cascade')->onUpdate('cascade');
            $table->float('tech3')->default(0);
            $table->float('zrel3')->default(0);
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
        Schema::drop('freescores');
    }
}
