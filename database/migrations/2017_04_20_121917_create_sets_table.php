<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sets', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
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
        Schema::dropIfExists('sets');
    }
}


lista_id INT PRIMARY KEY FOREIGN KEY (ref: tehtavalista)
id INT NOT NULL FOREIGN KEY (ref: kayttaja)
sessio_id SERIAL PRIMARY KEY
alk_aika TIMESTAMP DEFAULT current_timestamp
lop_aika TIMESTAMP

sessio_vastaus:
sessio_id PRIMARY KEY FOREIGN KEY (ref: sessio)
tehtava_id NOT NULL FOREIGN KEY (ref: tehtava)
vastaus TEXT
onko_oikein BOOLEAN
alk_aika TIMESTAMP DEFAULT current_timestamp
lop_aika TIMESTAMP
vastaus_tunnusnro PRIMARY KEY