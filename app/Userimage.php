<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Userimage extends Model
{
    //Table Name for example
    protected $table = 'userimages';
    //primary key i.e.
    public $primarykey = 'id';
    //Timestamps i.e.
    public $timestamps = true;

    //Creates relashionship between Post and User model function posts().
    public function user(){
        return $this->belongsTo('App\User');
    }
}
