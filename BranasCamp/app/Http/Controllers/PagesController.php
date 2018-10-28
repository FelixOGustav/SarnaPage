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

    protected $links = [
        'navLogoLink' => '/',
        'infoLink' => '/#branaslagretInfo',
        'prisLink' => '/#prisInfo',
        'reglerLink' => '/#ReglerInfo',
        'faqLink' => '/#faqInfo',
        'kontaktLink' => '/#KontaktInfo' 
    ];

    public function index(){
        return view('Pages/index') ->with('links', $this->StartPagelinkslinks);
    }

    public function template(){
        return view('Layouts/template') ->with('links', $this->links);
    }

    public function registration(){
        return view('Pages/registration') ->with('links', $this->links);
    }

    public function login(){
        return view('Pages/login') ->with('links', $this->links);
    }
}
