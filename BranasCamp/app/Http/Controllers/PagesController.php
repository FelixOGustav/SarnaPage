<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
        return view('Pages/index') ->with('links', $this->StartPagelinkslinks);
    }

    public function template(){
        return view('Layouts/template');
    }

    public function registration(){
        return view('Pages/registration');
    }

    public function login(){
        return view('Pages/login');
    }

    public function registrationDone(){
        return view('Pages/registrationdone');
    }

    public function gdpr(){
        return view('Pages/gdpr');
    }

    public function dashboard(){
        return view('AdminPages/dashboard');
    }
    public function registrationlists(){
        return view('AdminPages/registrationlists');
    }

    public function managemembers(){
        return view('AdminPages/managemebers');
    }
}
