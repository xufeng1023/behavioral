<?php

Route::get('/', function () {
    return view('auth.login');
})->middleware('guest');

Auth::routes();

Route::get('/home', 'HomeController@index');
Route::resource('answers', 'AnswersController');
