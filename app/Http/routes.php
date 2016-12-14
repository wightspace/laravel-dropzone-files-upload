<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});


Route::auth();

Route::get('/home', 'HomeController@index');
Route::post('/upload', 'FileController@upload');
Route::post('/remove-file', 'FileController@remove');
Route::post('/send-info', 'DocumentController@create');
Route::get('/show-file-{id}', 'FileController@showFile');
Route::get('/download-file-{id}', 'FileController@download');
Route::get('/delete-file-{id}', 'FileController@destroy');
Route::get('/delete-document-{id}', 'DocumentController@destroy');
Route::get('/open-file-{id}', 'FileController@open');

Route::get('/success', function () {
    return view('success');
});

Route::get('play', function () {
    return phpinfo();
});
