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

Route::get('/', function () {
  return view('welcome');
});

Auth::routes();

Route::get('/dashboard', 'DashboardController@index')->name('dashboard');

Route::prefix('/seguimiento_de_llamadas')->middleware('auth')->group(function () {
  Route::get('/', 'CallController@index')
       ->name('call_trackings');
  Route::get('/new', 'CallController@create')
       ->name('create_call');
  Route::post('/store/{id}', 'CallController@store')
       ->name('store_call');
  Route::get('/show/{id}', 'CallController@show')
       ->name('show_call');
  Route::get('/edit/{id}', 'CallController@edit')
       ->name('edit_call');
  Route::put('/uptate/{id}', 'CallController@update')
       ->name('update_call');
  Route::delete('/destroy/{id}', 'CallController@destroy')
       ->name('destroy_call');
});
