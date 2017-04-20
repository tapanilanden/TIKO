<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('ppt')->unique(); // Peruspalvelutunnus
            $table->string('name');
            $table->integer('major'); // Pääaine
            $table->string('email')->unique();
            $table->string('password');
            $table->integer('role')->default(3); // Käyttöoikeusluokka, default 3 <- opiskelija
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
