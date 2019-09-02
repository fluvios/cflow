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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', 'ParseController@index');
Route::post('/', 'ParseController@load');
Route::get('/filelist/{id?}', 'ParseController@readDirectory');
Route::get('/filelist/{id?}/{filename?}', 'ParseController@readFile');
Route::get('/analyze/{id?}', 'ParseController@analyze');
Route::get('/analyze/{syntax?}', 'ParseController@readSyntax');