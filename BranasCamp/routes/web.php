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
Route::get('/admin/login', 'PagesController@login');

Route::get('/a/{id}', function ($id) {
    return 'Hi. youre looking for ' .$id;
});