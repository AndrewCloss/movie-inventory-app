<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::namespace('Api')->group(function () {
    Route::get('/movies', 'MoviesController@index');
    Route::get('/movies/{movie}', 'MoviesController@show');
    Route::put('/movies/{movie}', 'MoviesController@update');
});
Route::namespace('Api')->group(function () {
    Route::get('/actors', 'ActorsController@index');
    Route::get('/actors/{actor}', 'ActorsController@show');
    Route::put('/actors/{actor}', 'ActorsController@update');
});
