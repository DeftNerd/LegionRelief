<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLegionnaireUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('legionnaire_user', function(Blueprint $table)
        {
            $table->integer('legionnaire_id')->unsigned()->nullable();
            $table->foreign('legionnaire_id')->references('id')->on('legionnaires')->onDelete('set null');
            $table->integer('user_id')->unsigned()->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('legionnaire_user');
    }
}
