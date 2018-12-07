<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AccessLevelController extends Controller
{
    public function Store($id){

        // Redirects user to start page if it does not have access to manage users
        if(!\App\accesslevel::find(Auth::user()->id)->manage_user){
            return redirect('/');
        }

        $access = \App\accesslevel::find($id);

        $access->admin = Request('admin');
        if($access->admin == null){
            $access->admin = 0;
        }
        $access->allergy = Request('allergy');
        if($access->allergy == null){
            $access->allergy = 0;
        }
        $access->other = Request('other');
        if($access->other == null){
            $access->other = 0;
        }
        $access->ljung = Request('ljung');
        if($access->ljung == null){
            $access->ljung = 0;
        }
        $access->vargarda = Request('vargarda');
        if($access->vargarda == null){
            $access->vargarda = 0;
        }
        $access->asklanda_ornunga = Request('asklanda_ornunga');
        if($access->asklanda_ornunga == null){
            $access->asklanda_ornunga = 0;
        }
        $access->bergstena_ostadkulle = Request('bergstena_ostadkulle');
        if($access->bergstena_ostadkulle == null){
            $access->bergstena_ostadkulle = 0;
        }
        $access->ljurhalla = Request('ljurhalla');
        if($access->ljurhalla == null){
            $access->ljurhalla = 0;
        }
        $access->t_r_e = Request('t_r_e');
        if($access->t_r_e == null){
            $access->t_r_e = 0;
        }
        $access->borgstena_tamta = Request('borgstena_tamta');
        if($access->borgstena_tamta == null){
            $access->borgstena_tamta = 0;
        }
        $access->storsjostrand = Request('storsjostrand');
        if($access->storsjostrand == null){
            $access->storsjostrand = 0;
        }
        $access->persnr = Request('persnr');
        if($access->persnr == null){
            $access->persnr = 0;
        }
        $access->contact_info = Request('contact_info');
        if($access->contact_info == null){
            $access->contact_info = 0;
        }
        $access->contact_info_advocate = Request('contact_info_advocate');
        if($access->contact_info_advocate == null){
            $access->contact_info_advocate = 0;
        }
        $access->verified_registration = Request('verified_registration');
        if($access->verified_registration == null){
            $access->verified_registration = 0;
        }
        $access->edit_registration = Request('edit_registration');
        if($access->edit_registration == null){
            $access->edit_registration = 0;
        }
        $access->manage_camp = Request('manage_camp');
        if($access->manage_camp == null){
            $access->manage_camp = 0;
        }
        $access->herrljunga = Request('herrljunga');
        if($access->herrljunga == null){
            $access->herrljunga = 0;
        }
        $access->add_user = Request('add_user');
        if($access->add_user == null){
            $access->add_user = 0;
        }
        $access->manage_user = Request('manage_user');
        if($access->manage_user == null){
            $access->manage_user = 0;
        }
        $access->statistics = Request('statistics');
        if($access->statistics == null){
            $access->statistics = 0;
        }
        $access->kitchen = Request('kitchen');
        if($access->kitchen == null){
            $access->kitchen = 0;
        }
        $access->schedule = Request('schedule');
        if($access->schedule == null){
            $access->schedule = 0;
        }
        $access->game_of_thrones = Request('game_of_thrones');
        if($access->game_of_thrones == null){
            $access->game_of_thrones = 0;
        }
        $access->age = Request('age');
        if($access->age == null){
            $access->age = 0;
        }

        $access->save();
        
        return redirect('/admin/manageusers');
    }
}
