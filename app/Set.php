<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Set extends Model
{
    
	public function answers()
    {
        return $this->belongsTo(Answer::class);
    }


}
