<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    public function tasklists() {
        return $this->belongsToMany('App\Tasklist');
    }
    
    public function user() {
        return $this->belongsTo('App\User');
    }
    
    public function modelAnswer() {
        return $this->hasOne('App\ModelAnswer');
    }
}
