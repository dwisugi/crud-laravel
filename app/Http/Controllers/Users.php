<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
class Users extends Controller
{
    function index() 
    {
        $user =  User::All();
        return view('user', ['user' => $user]);
    } 
}
