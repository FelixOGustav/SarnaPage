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

Route::get('/', 'PagesController@index');
Route::get('/template', 'PagesController@template');
Route::get('/registration', 'PagesController@registration');
//Route::get('/admin/login', 'PagesController@login');

Route::get('/registration/done','PagesController@registrationDone');
Route::get('/gdpr','PagesController@gdpr');

Route::group(['middleware' => 'auth'], function () {
    Route::get('/admin/dashboard', 'PagesController@dashboard');
    Route::get('/admin/registrationlists','PagesController@registrationlists');
    Route::get('/admin/managemembers','PagesController@managemembers');
    
    
    
});


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

Route::get('/a/{id}', function ($id) {
    return 'Hi. youre looking for ' .$id;
});



//Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');
