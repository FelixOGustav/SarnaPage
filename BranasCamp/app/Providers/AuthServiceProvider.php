<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Auth;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        $this->AccessPolicies();
    }

    public function AccessPolicies(){

        // Called before all other gates. If admin, it allows user, otherwise it continues to other gate
        Gate::before(function(){
            if(\App\accesslevel::find(Auth::user()->id)->admin == 1){
                return true;
            }
        });

        Gate::define('address', function(){
            if(\App\accesslevel::find(Auth::user()->id)->admin == 1){
                return true;
            }
        });

        Gate::define('member', function(){
            return \App\accesslevel::find(Auth::user()->id)->admin;
        });

        Gate::define('admin', function() {
            return \App\accesslevel::find(Auth::user()->id)->admin;
        });

        Gate::define('adduser', function() {
            return \App\accesslevel::find(Auth::user()->id)->add_user;
        });

        Gate::define('managecamps', function() {
            return \App\accesslevel::find(Auth::user()->id)->manage_camp;
        });
        
        Gate::define('manageusers', function() {
            return \App\accesslevel::find(Auth::user()->id)->manage_user;
        });
        
        Gate::define('seminars', function() {
            return \App\accesslevel::find(Auth::user()->id)->seminars;
        });

        Gate::define('allergy', function() {
            return \App\accesslevel::find(Auth::user()->id)->allergy;
        });
        
        Gate::define('other', function() {
            return \App\accesslevel::find(Auth::user()->id)->other;
        });
        
        Gate::define('statistics', function() {
            return \App\accesslevel::find(Auth::user()->id)->statistics;
        });
        
        Gate::define('manageusers', function() {
            return \App\accesslevel::find(Auth::user()->id)->manage_user;
        });

        Gate::define('game_of_thrones', function() {
            return \App\accesslevel::find(Auth::user()->id)->game_of_thrones;
        });

        Gate::define('insamling', function() {
            return \App\accesslevel::find(Auth::user()->id)->insamling;
        });

        Gate::define('schedule', function() {
            return \App\accesslevel::find(Auth::user()->id)->schedule;
        });
        
        Gate::define('editregistration', function() {
            return \App\accesslevel::find(Auth::user()->id)->edit_registration;
        });
        
        Gate::define('verifieregistration', function() {
            return \App\accesslevel::find(Auth::user()->id)->verified_registration;
        });
        
        Gate::define('ljung', function() {
            return \App\accesslevel::find(Auth::user()->id)->ljung;
        });
        
        Gate::define('vargarda', function() {
            return \App\accesslevel::find(Auth::user()->id)->vargarda;
        });
        
        Gate::define('asklanda_ornunga', function() {
            return \App\accesslevel::find(Auth::user()->id)->asklanda_ornunga;
        });
        
        Gate::define('bergstena_ostadkulle', function() {
            return \App\accesslevel::find(Auth::user()->id)->bergstena_ostadkulle;
        });
        
        Gate::define('ljurhalla', function() {
            return \App\accesslevel::find(Auth::user()->id)->ljurhalla;
        });
        
        Gate::define('t_r_e', function() {
            return \App\accesslevel::find(Auth::user()->id)->t_r_e;
        });
        
        Gate::define('borgstena_tamta', function() {
            return \App\accesslevel::find(Auth::user()->id)->borgstena_tamta;
        });
        
        Gate::define('storsjostrand', function() {
            return \App\accesslevel::find(Auth::user()->id)->storsjostrand;
        });
        
        Gate::define('herrljunga', function() {
            return \App\accesslevel::find(Auth::user()->id)->herrljunga;
        });
        
        Gate::define('age', function() {
            return \App\accesslevel::find(Auth::user()->id)->age;
        });

        Gate::define('persnr', function() {
            return \App\accesslevel::find(Auth::user()->id)->persnr;
        });

        Gate::define('kitchen', function() {
            return \App\accesslevel::find(Auth::user()->id)->kitchen;
        });
        
        Gate::define('contact_info', function() {
            return \App\accesslevel::find(Auth::user()->id)->contact_info;
        });
        
        Gate::define('contact_info_advocate', function() {
            return \App\accesslevel::find(Auth::user()->id)->contact_info_advocate;
        });

        Gate::define('registrationlists', function(){
            if(Auth::user()->can('ljung') || 
            Auth::user()->can('vargarda') ||
            Auth::user()->can('asklanda_ornunga') ||
            Auth::user()->can('bergstena_ostadkulle') ||
            Auth::user()->can('herrljunga') ||
            Auth::user()->can('storsjostrand') ||
            Auth::user()->can('borgstena_tamta') ||
            Auth::user()->can('t_r_e') ||
            Auth::user()->can('ljurhalla')){
                return true;
            }
            else {
                return false;
            }
        });

        Gate::define('exportreglists', function() {
            return \App\accesslevel::find(Auth::user()->id)->admin;
        });
    }
}
