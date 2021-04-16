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

Route::get('/', 'GameMechanicsController@login_screen');
Route::get('/{id}', 'GameMechanicsController@login_screen')->name('login_route');
Route::post('check', 'GameMechanicsController@check_key');
Route::post('teams/connect', 'GameMechanicsController@newTeamConnect');

Auth::routes();


