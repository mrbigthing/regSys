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

//Route::get('/', 'WelcomeController@index');

//Route::get('home', 'HomeController@index');

Route::get('/', 'HomeController@index');
Route::get('home', 'HomeController@index');

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);

Route::group(['prefix' => 'activities', 'namespace' => 'Activities'], function()  
{
  Route::get('/', 'ActivitiesController@index');
  Route::resource('activity', 'ActivityController');
});

Route::get('activity/{id}/registrationCount', 'Activities\ActivitiesController@getRegistrationCount');
Route::get('activity/{id}', 'Activities\ActivitiesController@show');

Route::get('profile/', 'ProfileController@index');
Route::resource('profile', 'ProfileController');

Route::post('registration/activity/{id}/submit_profile', 'ActivityRegistrationController@submitProfile');
Route::get('registration/activity/{id}/confirm', 'ActivityRegistrationController@store');
Route::get('registration/activity/{id}/edit_profile', 'ActivityRegistrationController@editProfile');
Route::get('registration/activity/{id}/export', 'ActivityRegistrationController@export');
Route::get('registration/activity/{id}', 'ActivityRegistrationController@create');
Route::get('unregistration/activity/{id}', 'ActivityRegistrationController@destroy');

Route::group(['prefix' => 'admin', 'namespace' => 'Admin'], function()  
{
  Route::get('/', 'AdminController@index');
  Route::get('/user/{id}/delete', 'AdminController@delete');
  Route::post('/user/{id}/edit', 'AdminController@edit');
  Route::get('/user/{id}/view', 'AdminController@show');
  Route::get('/user/{id}/reset', 'AdminController@reset');
  Route::get('/user/{id}/addAsAdmin', 'AdminController@addAsAdmin');
  Route::get('/user/{id}/removeFromAdmin', 'AdminController@removeFromAdmin');
  Route::resource('/user', 'AdminController');
});
