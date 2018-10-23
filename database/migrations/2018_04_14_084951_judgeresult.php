<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Judgeresult extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('results', function (Blueprint $table) {
            $table->float('score')->after('team_members');
            $table->integer('judge_id')->unsigned()->default(1);
            $table->foreign('judge_id')->references('id')->on('judges')->onDelete('cascade')->onUpdate('cascade')->after('rank_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('results', function (Blueprint $table) {
            //
        });
    }
}
