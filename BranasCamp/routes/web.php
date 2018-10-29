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
Route::get('/admin/dashboard', 'PagesController@dashboard');
Route::get('/registration/done','PagesController@registrationDone');
Route::get('/gdpr','PagesController@gdpr');


/*
// Authentication Routes...
Route::get('login', ['as' => 'login', 'uses' => 'Auth\LoginController@showLoginForm']);
Route::post('login', ['as' => '', 'uses' => 'Auth\LoginController@login']);
Route::post('logout', ['as' => 'logout', 'uses' => 'Auth\LoginController@logout']);

// Password Reset Routes...
Route::post('password/email', ['as' => 'password.email', 'uses' => 'Auth\ForgotPasswordController@sendResetLinkEmail']);
Route::get('password/reset', ['as' => 'password.request', 'uses' => 'Auth\ForgotPasswordController@showLinkRequestForm']);
Route::post('password/reset', ['as' => '', 'uses' => 'Auth\ResetPasswordController@reset']);
Route::get('password/reset/{token}', [ 'as' => 'password.reset', 'uses' => 'Auth\ResetPasswordController@showResetForm']);

// Registration Routes...
Route::get('register', ['as' => 'register', 'uses' => 'Auth\RegisterController@showRegistrationForm']);
Route::post('register', ['as' => '', 'uses' => 'Auth\RegisterController@register']);
*/



/*******************************************************
* För att ev. fixa routing av aut sidor, byt ut views 
* under views/auth till de vi vill ha. 
*
*******************************************************/

Route::get('/a/{id}', function ($id) {
    return 'Hi. youre looking for ' .$id;
});
<<<<<<< HEAD

Route::group(['prefix' => 'admin'], function () {
    Auth::routes();
});
=======
Auth::routes();
>>>>>>> 00ff0797cdf477f06813b7bb9b834b879f8bdce4

Route::get('/home', 'HomeController@index')->name('home');
