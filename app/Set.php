<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\Schema;

use Illuminate\Database\Schema\Blueprint;

class Set extends Model
{
    public function createData() {
    	Schema::create('opiskelijat' . $this->id, function (Blueprint $table) {
    		$table->integer('nro');
            $table->string('nimi');
            $table->string('p_aine');
        });

        Schema::create('kurssit' . $this->id, function (Blueprint $table) {
    		$table->integer('id');
            $table->string('nimi');
            $table->string('opettaja');
        });

        Schema::create('suoritukset' . $this->id, function (Blueprint $table) {
    		$table->integer('k_id');
            $table->integer('op_nro');
            $table->integer('arvosana');
        });
    }
    
    public function destroyData() {
        Schema::dropIfExists('opiskelijat'. $this->id);
        Schema::dropIfExists('kurssit'. $this->id);
        Schema::dropIfExists('suoritukset'. $this->id);
    }


	public function answers()
    {
        return $this->belongsTo('App\Answer');
    }

    public function user() {
    	return $this->belongsTo('App\User');
    }

    public function tasklist() {
    	return $this->hasOne('App\Tasklist');
    }


}
