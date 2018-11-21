<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PagesController extends Controller
{
    protected $StartPagelinkslinks = [
        'navLogoLink' => '#',
        'infoLink' => '#',
        'prisLink' => '#',
        'reglerLink' => '#',
        'faqLink' => '#',
        'kontaktLink' => '#' 
    ];

    protected $users;
    protected $places;
    protected $camp;

    /*
    //--- No longer needed. these are default if not overridden ---//
    protected $links = [
        'navLogoLink' => '/',
        'infoLink' => '/#branaslagretInfo',
        'prisLink' => '/#prisInfo',
        'reglerLink' => '/#ReglerInfo',
        'faqLink' => '/#faqInfo',
        'kontaktLink' => '/#KontaktInfo' 
    ];
    */

    public function index(){
        $camp = \App\registration_state::find(1);
        return view('Pages/index', ['links' => $this->StartPagelinkslinks, 'camp' => $camp]);
    }

    public function template(){
        return view('Layouts/template');
    }

    public function login(){
        return view('Pages/login');
    }

    public function gdpr(){
        return view('Pages/gdpr');
    }

    public function dashboard(){
        return view('AdminPages/dashboard');
    }
    public function registrationlists(){

        $placesIDArray = [];
        $user = Auth::user();
        $places = \App\place::all();

        if($user->can('ljung')){
            $placesIDArray[] = \App\place::where('placename', '=', 'Ljung')->first()->placeID;
        }
        if($user->can('asklanda_ornunga')){
            $placesIDArray[] = \App\place::where('placename', '=', 'Asklanda-Ornunga')->first()->placeID;
        }
        if($user->can('bergstena_ostadkulle')){
            $placesIDArray[] = \App\place::where('placename', '=', 'Bergstena-Östadkulle')->first()->placeID;
        }
        if($user->can('borgstena_tamta')){
            $placesIDArray[] = \App\place::where('placename', '=', 'Borgstena/Tämta')->first()->placeID;
        }
        if($user->can('herrljunga')){
            $placesIDArray[] = \App\place::where('placename', '=', 'Herrljunga')->first()->placeID;
        }
        if($user->can('ljurhalla')){
            $placesIDArray[] = \App\place::where('placename', '=', 'Ljurhalla')->first()->placeID;
        }
        if($user->can('storsjostrand')){
            $placesIDArray[] = \App\place::where('placename', '=', 'Storsjöstrand')->first()->placeID;
        }
        if($user->can('t_r_e')){
            $placesIDArray[] = \App\place::where('placename', '=', 'Tåstorp/Rensvist/Eggvena/Lagmansholm')->first()->placeID;
        }
        if($user->can('vargarda')){
            $placesIDArray[] = \App\place::where('placename', '=', 'Vårgårda')->first()->placeID;
        }


        $registrations = \App\registration::whereIn('place', $placesIDArray)->get();
        $registrations_leaders = \App\registrations_leader::whereIn('place', $placesIDArray)->get();

        $regAmount = \App\registrations_leader::count() + \App\registration::count();
        return view('AdminPages/registrationlists', ['registrations' => $registrations, 'registrations_leaders' => $registrations_leaders, 'places' => $places, 'count' => $regAmount]);
    }

    public function manageusers(){
        $users = \App\User::all();
        return view('AdminPages/managemebers', ['users' => $users]);
    }

    public function manageuser($id){
        $user = \App\User::find($id);
        $access = \App\accesslevel::find($id);
        return view('AdminPages/manageuser', ['user' => $user, 'access' => $access]);
    }

    public function registrationfull(){
        return view('Pages/registrationfull');
    }

    public function registrationExists(){
        return view('Pages/registrationexist');
    }

    public function managecamps(){
        $camps = \App\registration_state::all();
        return view('AdminPages/managecamps', ['camps' => $camps]);
    }

    public function managecamp($id){
        $camp = \App\registration_state::find($id);
        return view('AdminPages/managecamp', ['camp' => $camp]);
    }

    public function CloseRegistration($id){
        $camp = \App\registration_state::find($id);
        $camp->open = 0;
        $camp->save();
        return redirect('/admin/managecamp/camp/' . $camp->id);
    }

    public function OpenRegistration($id){
        $camp = \App\registration_state::find($id);
        $camp->open = 1;
        $camp->save();
        return redirect('/admin/managecamp/camp/' . $camp->id);
    }

    public function About(){
        return view('Pages/about');
    }

    // Remove before publishing. Just temp to develop verification email
    public function testmail(){
        $registration= new \App\Registration();
        //return request()->all();
        
        $registration->first_name = 'Karl';
        $registration->last_name = 'Karlsson';
        $registration->birthdate = 1337-13-37;
        $registration->last_four = 1337;
        $registration->address = 'EliteStreet 3';
        $registration->zip = 13337;
        $registration->city = 'Ljung';
        $registration->email = 'test@test.se';
        $registration->first_name_advocate = 'Anders';
        $registration->last_name_advocate = 'Andersson';
        $registration->place = 0;

        return view('Emails/registeredemail', ['registration' => $registration, 'link' => 'branaslagret.test']);
    }
}
