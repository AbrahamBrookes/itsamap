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

Route::prefix('dashboard')->middleware('auth')->group(function(){
	
	Route::get('/', function () {
		
		$maps = Auth::user()->maps;
		return view('admin.dashboard', [
			'maps' => $maps,
		]);
	});
	

	Route::resources([
		'maps' 		=> 'MapsController',
		'pointers' 	=> 'MapPointersController'
	]);
	
});


Route::get('/', function () {
    return view('home');
});
Route::get('home', function () {
    return view('home');
});


Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');
