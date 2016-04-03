<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::auth();

Route::get('/home', 'HomeController@index');

Route::resource('about', 'AboutController', ['only' => ['index']]);
//Route::resource('contact', 'ContactController', ['only' => ['create', 'store']]);
Route::get('contact', [
	'as' => 'contact',
    'uses' => 'ContactController@create'
]);
Route::post('contact', [
	'as' => 'contact_store',
    'uses' => 'ContactController@store'
]);