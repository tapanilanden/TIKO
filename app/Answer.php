<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    public function set()
    {
        return $this->belongsTo('App\Set');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }
    


}
