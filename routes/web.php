<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
});

//Auth::routes();
Route::group(['middleware'=>['guest']],function(){

	Route::get('/', function()
	{
	return view('auth.login');
	 });

});

Auth::routes(['register' => false]);
Route::get('/home', 'HomeController@index')->name('home');



Route::resource('earths', 'EarthController');
Route::get('Print_earth/{id}','EarthController@Print_earth');

Route::resource('reports', 'ReportsController');
Route::get('square', 'ReportsController@square');
Route::resource('squares', 'SquareController');


Route::group(['middleware' => ['auth']], function() {
    
    Route::resource('roles','RoleController');
    Route::resource('users','UserController');
	Route::get('/changePassword','UserController@showChangePasswordForm')->name('changePassword');
    Route::post('/changePassword','UserController@changePassword')->name('changePassword');

});


                             

Route::get('/{page}', 'AdminController@index');