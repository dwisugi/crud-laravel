<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    function company(){
        return $this->hasMany('App\Cmp'); 
    }  
}
