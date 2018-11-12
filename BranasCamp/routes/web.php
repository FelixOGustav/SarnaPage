<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
/*
Route::get('/', function () {
    return view('welcome');
});

*/

Route::get('/', 'PagesController@index')->name('start');
Route::get('/template', 'PagesController@template');
Route::get('/registration', 'CampRegistrationController@registration');
Route::get('/registration/leader', 'CampRegistrationController@registrationLeader');
//Route::get('/admin/login', 'PagesController@login');

Route::get('/registration/done/{type}/{id}','CampRegistrationController@registrationDone');
Route::post('/registration/done','CampRegistrationController@store');
Route::get('/registration/leader/done/{id}','CampRegistrationController@registrationDone');
Route::post('/registration/leader/done','CampRegistrationController@storeLeader');
Route::get('/registration/verify/done/{type}/{id}', 'CampRegistrationController@VerificationDone');
Route::get('/gdpr','PagesController@gdpr');
Route::get('/registrationfull', 'PagesController@registrationfull');
Route::get('/registrationExists', 'Pagescontroller@registrationExists');
Route::get('/admin/registrationlists/{type}/{id}', 'CampRegistrationController@ResendVerificationEmail');

Route::get('/registration/verify/{type}/{id}', 'CampRegistrationController@VerifyRegistration')->name('event.verifyRegistration')->middleware('signed');

Route::group(['middleware' => 'auth'], function () {
    Route::get('/admin/dashboard', 'PagesController@dashboard');
    Route::get('/admin/registrationlists','PagesController@registrationlists');
    Route::get('/admin/manageusers','PagesController@manageusers');
    Route::get('/admin/managerusers/user/{id}', 'PagesController@manageuser');
    Route::get('/admin/managecamps', 'PagesController@managecamps');
    Route::get('/admin/managecamp/camp/{id}', 'PagesController@managecamp');
    Route::get('/admin/managecamp/close/{id}', 'PagesController@CloseRegistration');
    Route::get('/admin/managecamp/open/{id}', 'PagesController@OpenRegistration');
});


use Illuminate\Routing\UrlGenerator;
Route::get('/test', function(){
    return url('/');
});

//Route::get('/test/mail', 'PagesController@testmail');


Route::group(['prefix' => 'admin'], function () {
    //Auth::routes();

    // Authentication Routes...
    $this->get('login', 'Auth\LoginController@showLoginForm')->name('login');
    $this->post('login', 'Auth\LoginController@login');
    $this->post('logout', 'Auth\LoginController@logout')->name('logout');

    Route::group(['middleware' => 'auth'], function () {
        // Registration Routes...
        if ($options['register'] ?? true) {
            $this->get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
            $this->post('register', 'Auth\RegisterController@register');
        }
    });

    // Password Reset Routes...
    $this->get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
    $this->post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
    $this->get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
    $this->post('password/reset', 'Auth\ResetPasswordController@reset')->name('password.update');

    // Email Verification Routes...
    if ($options['verify'] ?? false) {
        $this->emailVerification();
    }
});

/*******************************************************
* För att ev. fixa routing av aut sidor, byt ut views 
* under views/auth till de vi vill ha. 
*
*******************************************************/

Route::get('/a/{id}/{id2}', function ($id, $id2) {
    return 'Hi. youre looking for ' .$id . ' and ' .$id2;
});



//Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');
