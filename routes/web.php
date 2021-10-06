<?php

use Illuminate\Support\Facades\Route;

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
Route::get('/', 'HomeController@index');

Route::get('/country/{id}', 'CountryController@show');
Route::get('/country/{id}/edit', 'CountryController@edit')->middleware('auth');
Route::put('/country/{id}', 'CountryController@update')->middleware('auth');

Route::get('/admin', function () { return view('auth.login');});
Route::get('/reset_countries', 'ResetDBController@country')->middleware('auth');
Route::get('/reset_data', 'ResetDBController@data')->middleware('auth');

Auth::routes();
