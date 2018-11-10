<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CampRegistrationController extends Controller
{
    protected $places;

    public function registration(){
        $places = \App\place::all();
        return view('Pages/registration', ['places' => $places]);
    }

    public function store(){
        
        $registration= new \App\Registration();
        $registration->first_name = Request('firstname');

        $registration->save();
        return redirect('/registration/done');
    }
}
