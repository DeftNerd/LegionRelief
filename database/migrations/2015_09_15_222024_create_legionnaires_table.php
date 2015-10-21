<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLegionnairesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('legionnaires', function (Blueprint $table) {
            $table->increments('id');
	    $table->string('slug')->nullable();
            $table->string('name');
	    $table->string('handle')->nullable();
	    $table->string('oneline')->default('');
	    $table->mediumtext('address')->nullable();
	    $table->mediumtext('contact')->nullable();
	    $table->timestamp('charged_at')->nullable()->default(null);
	    $table->mediumtext('charges')->nullable();
	    $table->timestamp('sentenced_at')->nullable()->default(null);
	    $table->mediumtext('sentences')->nullable();
	    $table->timestamp('released_at')->nullable()->default(null);
	    $table->timestamp('paroled_at')->nullable()->default(null);
            $table->mediumtext('description');
	    $table->mediumtext('status')->nullable();
	    $table->integer('star_count')->default(0);
            $table->integer('user_id')->unsigned()->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
	    $table->timestamp('approved')->nullable()->default(null);
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
        Schema::drop('legionnaires');
    }
}
