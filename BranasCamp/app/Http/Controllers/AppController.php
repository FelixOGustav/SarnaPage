<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AppController extends Controller
{
    public function Index(){
        return view('App/appIndex');
    }

    public function Schedule(){
        return view('App/schedule');
    }
}
