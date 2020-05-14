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

// Controller-name@method-name
Route::get('/', 'DateCal@index'); // localhost:8000/
Route::get('/{id}', 'DateCal@index');
Route::post('/save', 'DateCal@save');
Route::post('/AjaxSave', 'DateCal@AjaxSave');
Route::get('/deleteUser/{id}', 'DateCal@deleteUser');