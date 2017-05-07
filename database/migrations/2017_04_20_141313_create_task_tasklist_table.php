<?php
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
class CreateListTaskTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('task_tasklist', function (Blueprint $table) {
            $table->integer('task_id')->unsigned()->index();
            $table->integer('tasklist_id')->unsigned()->index();
            
            $table->foreign('task_id')->references('id')->on('tasks')->onDelete('cascade');
            $table->foreign('tasklist_id')->references('id')->on('tasklists')->onDelete('cascade');
            
            $table->unique(['task_id', 'tasklist_id']);
                   
         });
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('task_tasklist');
    }
}



