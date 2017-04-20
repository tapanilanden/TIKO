<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    public function sets()
    {
        return $this->belongsTo(Set::class);
    }

    public function users()
    {
        return $this->belongsTo(User::class);
    }


}
