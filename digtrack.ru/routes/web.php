<?php


// Административная панель
// Игровые методы
Route::post('teams/connect',              'GameMechanicsController@newTeamConnect')->middleware('throttle:60,5');
Route::post('public_news_publication',    'GameMechanicsController@public_news_publication')->name('public_news_publication')->middleware('throttle:60,5');
Route::post('private_news_publication',   'GameMechanicsController@private_news_publication')->name('private_news_publication')->middleware('throttle:60,5');
Route::post('dynamic',                    'GameMechanicsController@dynamic')->name('dynamic')->middleware('throttle:60,5');
Route::post('newcards',                   'GameMechanicsController@newcards')->name('newcards')->middleware('throttle:60,5');
Route::post('newday',                     'GameMechanicsController@newDay')->name('newday')->middleware('throttle:60,5');
Route::post('step/choose',                'GameMechanicsController@step')->name('step')->middleware('throttle:60,5');
Route::post('day_result',                 'GameMechanicsController@day_result')->name('day_result')->middleware('throttle:60,5');
Route::post('check',                      'GameMechanicsController@check_key')->name('check')->middleware('throttle:60,5');
Route::post('rating_list',                'GameMechanicsController@getRatingList')->name('getRatingList')->middleware('throttle:60,5');
Route::post('key',                        'GameMechanicsController@getRandomKey')->name('getRandomKey')->middleware('throttle:60,5');
Route::get('/game/{key}',                 'GameMechanicsController@game_screen')->name('check')->middleware('throttle:60,5');
Route::get('/rules/{key}',                'GameMechanicsController@game_rules')->middleware('throttle:60,5');
Route::get('/results/{key}',              'GameMechanicsController@game_results')->middleware('throttle:60,5');
Route::get('/certificate/{key}',          'GameMechanicsController@get_certtificate')->middleware('throttle:60,5');
Route::post('/send_cert_email',           'GameMechanicsController@send_cert_email')->middleware('throttle:60,5');
Route::get('/',                           'GameMechanicsController@login_screen')->middleware('throttle:60,5');
Route::get('/{id}',                       'GameMechanicsController@login_screen')->name('login_route')->middleware('throttle:60,5');
