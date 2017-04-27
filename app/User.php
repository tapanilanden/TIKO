<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'ppt', 'major'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function answers()
    {
      return $this->hasMany(Answers::class);
    }
    
    public function tasks() {
        return $this->hasMany('App\Task');
    }
    
    public function tasklists() {
        return $this->hasMany('App\Tasklist');
    }

    public function sets() {
        return $this->hasMany('App\Set');
    }

}
