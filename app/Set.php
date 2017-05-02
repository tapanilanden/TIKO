<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\Schema;

use Illuminate\Database\Schema\Blueprint;

Use DB;

class Set extends Model
{
    public static function createData($id) {
    	Schema::create('opiskelijat' . $id, function (Blueprint $table) {
    		$table->integer('nro');
            $table->string('nimi');
            $table->string('p_aine');
        });

        Schema::create('kurssit' . $id, function (Blueprint $table) {
    		$table->integer('id');
            $table->string('nimi');
            $table->string('opettaja');
        });

        Schema::create('suoritukset' . $id, function (Blueprint $table) {
    		$table->integer('k_id');
            $table->integer('op_nro');
            $table->integer('arvosana');
        });

        DB::table('opiskelijat' . $id)->insert([
            'nro' => 1,
            'nimi' => 'Maija',
            'p_aine' => 'TKO',
        ]);

        DB::table('opiskelijat' . $id)->insert([
            'nro' => 2,
            'nimi' => 'Ville',
            'p_aine' => 'TKO',
        ]);

        DB::table('opiskelijat' . $id)->insert([
            'nro' => 3,
            'nimi' => 'Kalle',
            'p_aine' => 'VT',
        ]);

        DB::table('opiskelijat' . $id)->insert([
            'nro' => 4,
            'nimi' => 'Liisa',
            'p_aine' => 'VT',
        ]);

        DB::table('kurssit' . $id)->insert([
            'id' => 1,
            'nimi' => 'tkp',
            'opettaja' => 'KI',
        ]);

        DB::table('kurssit' . $id)->insert([
            'id' => 2,
            'nimi' => 'oope',
            'opettaja' => 'JL',
        ]);

        DB::table('kurssit' . $id)->insert([
            'id' => 3,
            'nimi' => 'tiko',
            'opettaja' => 'MJ',
        ]);

        DB::table('suoritukset' . $id)->insert([
            'k_id' => 1,
            'op_nro' => 1,
            'arvosana' => 5,
        ]);

        DB::table('suoritukset' . $id)->insert([
            'k_id' => 1,
            'op_nro' => 2,
            'arvosana' => 4,
        ]);

        DB::table('suoritukset' . $id)->insert([
            'k_id' => 1,
            'op_nro' => 3,
            'arvosana' => 2,
        ]);

        DB::table('suoritukset' . $id)->insert([
            'k_id' => 2,
            'op_nro' => 1,
            'arvosana' => 5,
        ]);

        DB::table('suoritukset' . $id)->insert([
            'k_id' => 2,
            'op_nro' => 2,
            'arvosana' => 3,
        ]);

        DB::table('suoritukset' . $id)->insert([
            'k_id' => 2,
            'op_nro' => 4,
            'arvosana' => 3,
        ]);

        DB::table('suoritukset' . $id)->insert([
            'k_id' => 3,
            'op_nro' => 1,
            'arvosana' => 5,
        ]);

        DB::table('suoritukset' . $id)->insert([
            'k_id' => 3,
            'op_nro' => 2,
            'arvosana' => 4,
        ]);
    }
    
    public function destroyData() {
        Schema::dropIfExists('opiskelijat');
        Schema::dropIfExists('kurssit');
        Schema::dropIfExists('suoritukset');
    }


	public function answers()
    {
        return $this->belongsTo('App\Answer');
    }

    public function user() {
    	return $this->belongsTo('App\User');
    }

    public function tasklist() {
    	return $this->belongsTo('App\Tasklist');
    }


}
