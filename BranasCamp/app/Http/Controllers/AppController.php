<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Auth;
use Illuminate\Support\Facades\Cookie;

class AppController extends Controller
{

    public function Index(Request $request){
        $leader = Cookie::get('AppSettings_Leader', '0');
        
        //return redirect('/app/schedule');
        return view('App/appIndex', ['uri' => $request->path(), 'leaderSetting' => $leader]);
    }

    public function Schedule(Request $request){
        $events = \App\schedule_event::orderBy('time', 'asc')->get();
        $days = \App\schedule_day::all();

        $leader = Cookie::get('AppSettings_Leader', '0');

        return view('App/schedule', ['events' => $events, 'days' => $days, 'leaderSetting' => $leader, 'uri' => $request->path()]);
    }

    public function Seminars(Request $request){
        $seminars = \App\seminar::orderBy('date', 'asc')->get();
        $dates = \App\seminar::distinct('date')->pluck('date')->sort();
        $seminarInfo = \App\seminarinfo::all()->first();

        $leader = Cookie::get('AppSettings_Leader', '0');
        return view('App/seminars', ['uri' => $request->path(), 'leaderSetting' => $leader, 'seminars' => $seminars, 'dates' => $dates, 'seminarInfo' => $seminarInfo]);
    }

    public function GameOfThrones(Request $request){
        $leader = Cookie::get('AppSettings_Leader', '0');
        $toilets = \App\gameofthrone::all();
        $info = \App\gameofthronesinfo::all()->first();

        return view('App/gameOfThrones', ['uri' => $request->path(), 'leaderSetting' => $leader, 'toilets' => $toilets, 'info' => $info]);
    }

    public function Donation(Request $request){
        $leader = Cookie::get('AppSettings_Leader', '0');
        $insamling = \App\insamling::all()->first();

        return view('App/donation', ['uri' => $request->path(), 'leaderSetting' => $leader, 'insamling' => $insamling]);
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

    public function UpdateSettings(Request $request){
        $leaderSetting = Request('leader');
        if($leaderSetting == null){
            $leaderSetting = 0;
        }

        //20160 = Minutes until expire. (14 days)
        return redirect($request->uri)->cookie('AppSettings_Leader', $leaderSetting, 20160);
    }
}
