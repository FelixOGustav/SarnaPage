<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AppController extends Controller
{

    public function Index(Request $request){
        return view('App/appIndex', ['uri' => $request->path()]);
    }

    public function Schedule(Request $request){
        $events = \App\schedule_event::all();

        return view('App/schedule', ['events' => $events, 'uri' => $request->path()]);
    }

    public function Seminars(Request $request){
        return view('App/seminars', ['uri' => $request->path()]);
    }

    public function GameOfThrones(Request $request){
        return view('App/gameOfThrones', ['uri' => $request->path()]);
    }

    public function Donation(Request $request){
        return view('App/donation', ['uri' => $request->path()]);
    }
}
