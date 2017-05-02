<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tasklist extends Model
{
    public function tasks() {
        return $this->belongsToMany('App\Task');
    }
    
    public function user() {
        return $this->belongsTo('App\User');
    }

    public function sets() {
    	return $this->hasMany('App\Set');
    }
}
