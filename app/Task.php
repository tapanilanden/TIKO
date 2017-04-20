<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    public function lists() {
        return $this->belongsToMany('App\List');
    }
    
    public function user() {
        return $this->belongsTo('App\User');
    }
    
    public function modelAnswers() {
        return $this->hasMany('App\ModelAnswer');
    }
}
