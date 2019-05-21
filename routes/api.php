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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/fields', 'FieldController@index');
Route::get('/fields/{field}', 'FieldController@show');
Route::post('/fields', 'FieldController@store');
Route::delete('/fields/{field}', 'FieldController@destroy');


Route::get('/entities', 'EntityController@index');  //TODO
Route::get('/entities/{entity}', 'EntityController@show'); //TODO
Route::post('/entities', 'EntityController@store'); //TODO
Route::delete('/entities/{entity}', 'EntityController@destroy'); //TODO
