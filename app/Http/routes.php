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

Route::get('/', 'WelcomeController@index');

//DVD Homework
Route::get('/dvds/search','DvdController@search');
Route::get('/dvds','DvdController@results');


//FEB 10 Class Example
//Route::get('/songs/search','SongsController@search');
//Route::get('/songs','SongsController@results');

//FEB 17 Class Example
Route::get('/songs/new','SongController@create');
Route::post('/songs','SongController@storeSong');

//DVD Homework Part 2
Route::get('/dvds/{id}','DvdController@getDvdDetails');
Route::post('/dvds/submitReview','DvdController@submitReview');