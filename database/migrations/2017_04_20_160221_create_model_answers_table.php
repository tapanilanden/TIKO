<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateModelAnswersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /* HUOM!
         * Koska tämä on heikko entiteetti, tässä kuuluisi olla yhdistelmäavain pääavaimena.
         * Laravelin eloquent ei tällaista kuitenkaan tue, joten tässä on nyt vain yksi pääavain.
         */
        Schema::create('model_answers', function (Blueprint $table) {
            $table->increments('id');
            $table->text('body');
            $table->timestamps();
            $table->integer('task_id')->unsigned();
            
            $table->foreign('task_id')->references('id')->on('tasks')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('model_answers');
    }
}
