<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->increments('id'); //---------Korvaa tehtava_id:n
            $table->timestamps(); //-------------Korvaa pvm:n
            $table->text('description');
            $table->integer('type'); //----------Tyyppi int 8 pituisen varcharin sijaan
            $table->text('model_query');
            $table->integer('user_id')->unsigned(); //-------Korvaa id:n
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tasks');
    }
}
