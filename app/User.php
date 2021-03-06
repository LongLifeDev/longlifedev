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
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    //Creates relashion ship between User and many Posts
    public function posts(){
        return $this->hasMany('App\Post');
    }

    //Creates relashion ship between User and many Userimages
    public function userimages(){
        return $this->hasMany('App\Userimage');
    }
}
