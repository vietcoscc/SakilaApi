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

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});
Route::resource('films', 'FilmController');
Route::get('/actor/{id}', 'FilmController@getActor');
Route::get('/film/{id}', 'FilmController@getFilm');
Route::get('/film/text/{id}', 'FilmController@getFilmText');
Route::get('/film/inventory/{id}', 'FilmController@getInventory');