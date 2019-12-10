<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cmp extends Model
{
    protected $table= 'company';
    public function user(){
    	return $this->belongsTo('App\User');
    } 
}
