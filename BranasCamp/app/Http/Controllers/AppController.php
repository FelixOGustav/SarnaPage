<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Auth;

class AppController extends Controller
{

    public function Index(Request $request){
        return view('App/appIndex', ['uri' => $request->path()]);
    }

    public function Schedule(Request $request){
        $events = \App\schedule_event::orderBy('time', 'asc')->get();
        $days = \App\schedule_day::all();

        return view('App/schedule', ['events' => $events, 'days' => $days, 'uri' => $request->path()]);
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

    public function EditSchedule($date = '', Request $request){
        if($date == '' || $date == null){
            $date = '2018-12-27';
        }
        $day = \App\schedule_day::all()->where('date', '=', $date)->first();

        if($day == null){
            return redirect('/admin/schedule');
        }

        $events = \App\schedule_event::orderBy('time', 'asc')->get();

        return view('AdminPages/editSchedule', ['day' => $day, 'events' => $events, 'uri' => $request->path()]);
    }

    public function SaveDay($id, Request $request){
        $day = \App\schedule_day::find($id);
        
        $day->info = Request('info');
        $day->save();

        return redirect('/admin/schedule/'.$day->date);
    }

    public function DeleteEvent($id){
        $event = \App\schedule_event::find($id);
        $event->delete();

        return redirect('/admin/schedule/'.Carbon::parse($event->time)->format('Y-m-d'));
    }

    public function NewEvent(){
        $event = new \App\schedule_event();
        $event->titel = Request('titel');
        $event->description = Request('description');
        $event->time = Request('time');
        $event->time_end = Request('time_end');
        $event->leader = Request('leader');
        $event->changed_by = Auth::user()->name;

        $event->save();

        return redirect('/admin/schedule/'.Carbon::parse($event->time)->format('Y-m-d'));
    }
}
