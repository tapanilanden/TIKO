<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ModelAnswer extends Model
{

	protected $fillable = [
        'body'
    ];

    public function task() {
        return $this->hasOne('App\Task');
    }
}
