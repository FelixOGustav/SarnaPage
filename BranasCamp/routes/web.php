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
Route::get('/about', 'PagesController@About');
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
Route::get('/registrationExists', 'PagesController@registrationExists');
Route::get('/invalidaddress', 'PagesController@invalidaddress');
Route::get('/lateregistration/{key}', 'CampRegistrationController@lateRegistration');
Route::get('/lateregistration-leader/{key}', 'CampRegistrationController@lateRegistrationLeader');
Route::post('/registration/leader/{key}/done', 'CampRegistrationController@LateStoreLeader');
Route::post('/registration/{key}/done', 'CampRegistrationController@LateStore');

Route::post('/lateregistrationsignup', 'CampRegistrationController@Lateregistrationsignup');

Route::get('/registration/verify/{type}/{id}', 'CampRegistrationController@VerifyRegistration')->name('event.verifyRegistration')->middleware('signed');

Route::group(['middleware' => 'auth'], function () {
    Route::get('/admin/dashboard', 'PagesController@dashboard');
    Route::get('/admin/registrationlists/{type}','PagesController@registrationlists')->middleware('can:registrationlists');
    Route::get('/admin/manageusers','PagesController@manageusers')->middleware('can:manageusers');
    Route::get('/admin/manageusers/user/{id}', 'PagesController@manageuser')->middleware('can:manageusers');
    Route::get('/admin/managecamps', 'PagesController@managecamps')->middleware('can:managecamps');
    Route::get('/admin/managecamp/camp/{id}', 'PagesController@managecamp')->middleware('can:managecamps');
    Route::get('/admin/managecamp/close/{id}', 'PagesController@CloseRegistration')->middleware('can:managecamps');
    Route::get('/admin/managecamp/open/{id}', 'PagesController@OpenRegistration')->middleware('can:managecamps');
    Route::get('/admin/managecamp/closelate/{id}', 'PagesController@CloseLateRegistration')->middleware('can:managecamps');
    Route::get('/admin/managecamp/openlate/{id}', 'PagesController@OpenLateRegistration')->middleware('can:managecamps');
    Route::get('/admin/registrationlists/{type}/{id}', 'CampRegistrationController@ResendVerificationEmail')->middleware('can:editregistration');
    Route::get('/admin/editregistration/{type}/{id}', 'CampRegistrationController@EditRegistration')->middleware('can:editregistration');
    Route::post('/admin/editregistration/done/{type}/{id}', 'CampRegistrationController@StoreEdit')->middleware('can:editregistration');
    Route::post('/admin/manageuser/user/done/{id}', 'AccessLevelController@Store')->middleware('can:manageusers');
    Route::get('/admin/lateregistration', 'PagesController@lateregistration')->middleware('can:admin');
    Route::post('/admin/addlateregistration', 'PagesController@addLateRegistration')->middleware('can:admin');
    Route::get('/admin/lateregistration/remove/{id}', 'PagesController@removeLateRegistration')->middleware('can:admin');
    Route::get('/admin/mail', 'MailController@Mail')->middleware('can:admin');
    Route::post('/admin/mail/new', 'MailController@Store')->middleware('can:admin');
    Route::post('/admin/mail/update/save/{id}', 'MailController@Update')->middleware('can:admin');
    Route::get('/admin/mail/update/{id}', 'MailController@UpdateServe')->middleware('can:admin');
    Route::get('/admin/mail/remove/{id}', 'MailController@Remove')->middleware('can:admin');
    Route::post('/admin/mail/send', 'MailController@Send')->middleware('can:admin');
    Route::post('/admin/mail/send/progress', 'MailController@Progress')->middleware('can:admin');
    Route::get('/admin/mail/duplicate/{id}', 'MailController@Duplicate')->middleware('can:admin');
    Route::get('/admin/mail/clearsendstats/{id}', 'MailController@ClearSendStats')->middleware('can:admin');
});


use Illuminate\Routing\UrlGenerator;
Route::get('/test', 'PagesController@NewAdminTemplateTemp');

Route::get('/test/mail/{id}', function ($id) {
    return view('Emails/defaultmail', ['mail' => \App\mail::find($id)]);
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

Route::get('/a/{id}/{id2}', function ($id, $id2) {
    return 'Hi. youre looking for ' .$id . ' and ' .$id2;
});



//Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');
