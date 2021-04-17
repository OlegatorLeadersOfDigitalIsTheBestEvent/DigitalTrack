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

Route::post('public_news_publication', 'GameMechanicsController@public_news_publication');
Route::post('private_news_publication', 'GameMechanicsController@private_news_publication');
Route::post('dynamic', 'GameMechanicsController@dynamic');
Route::post('step/choose', 'GameMechanicsController@step');
Route::post('day_result', 'GameMechanicsController@day_result');
Route::post('newcards', 'GameMechanicsController@newcards');

Route::get('/game/{lang}/{key}', 'GameMechanicsController@game_screen')->name('check');
Route::get('/rules/{lang}/{key}', 'GameMechanicsController@game_rules');
Route::get('/results/{lang}/{key}', 'GameMechanicsController@game_results');


Auth::routes();


