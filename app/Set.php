<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Set extends Model
{
    


	public function answers()
    {
        return $this->belongsTo('App\Answer');
    }

    public function user() {
    	return $this->belongsTo('App\User');
    }

    public function list() {
    	return $this->hasOne('App\List');
    }


}
