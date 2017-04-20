<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ModelAnswer extends Model
{
    public function task() {
        return $this->belongsTo('App\Task');
    }
}
