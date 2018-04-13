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

Route::get('books','Books@index');
Route::get('books/filter','Books@filter');
Route::get('books/{id}','Books@show');
Route::post('books','Books@store');
Route::put('books/{id}','Books@update');
Route::delete('books/{id}','Books@delete');

Route::get('categories','Categories@index');

Route::post('register', 'Auth\RegisterController@register');
