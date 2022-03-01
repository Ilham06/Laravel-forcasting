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

Route::get('/', 'ForcastingController@index');

Route::resource('forcasting', 'ForcastingController');

Route::post('forcasting/hitung', 'ForcastingController@hitung')->name('forcasting.hitung');
Route::post('forcasting/ramal', 'ForcastingController@ramal')->name('forcasting.ramal');
Route::post('forcasting/reset', 'ForcastingController@reset')->name('forcasting.reset');
