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

Route::post('/all-customers',               'HomeController@allCustomers');
Route::post('/all-positions',               'HomeController@allPositions');
Route::post('/all-departments',             'HomeController@allDepartments');
Route::get('/department/new',    'HomeController@departmentCreate');



Route::post('/get-customer',                'HomeController@getCustomer');
Route::post('/left-customer',               'HomeController@leftCustomer');
Route::post('/get-customers-by-department', 'HomeController@getCustomersByDepartment');



Route::post('/scripts-list',    'HomeController@scriptsList');
Route::post('/selected-list',    'HomeController@selectedList');

Route::get('/teach/start/{ids}',    'HomeController@teach');
Route::get('/test/start/{ids}',    'HomeController@test');

Route::get('/customer/create',    'HomeController@customerCreate');
Route::get('/customer/{id}',    'HomeController@customer');
Route::get('/departments',  'HomeController@departments')->name('departments');
Route::get('/positions',    'HomeController@positions')->name('positions');


Route::post('/start-teach',    'HomeController@startTeach');

Route::post('/get-customer-teach-stat',    'HomeController@teachStat');

Route::post('/new-customer',    'HomeController@createCustomer');
Route::post('/new-department',  'HomeController@createDepartment');
Route::post('/new-position',    'HomeController@createPosition');


Route::get('/home', 'HomeController@index')->name('home');
Route::get('/statistic',    'HomeController@statistic');
