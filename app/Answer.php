<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    public function sets()
    {
        return $this->belongsTo('App\Set');
    }

    public function users()
    {
        return $this->belongsTo('App\User');
    }
    


}
