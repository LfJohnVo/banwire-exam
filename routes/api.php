<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::get('/merchants', 'App\Http\Controllers\ComercioController@index');
Route::post('merchants', 'App\Http\Controllers\ComercioController@store');
Route::put('merchants/{id}', 'App\Http\Controllers\ComercioController@update');
Route::post('transactions', 'App\Http\Controllers\TransaccionController@store');
Route::get('bancomisions', 'App\Http\Controllers\ComercioController@getBanwire');
Route::get('merchantcomision/{id}', 'App\Http\Controllers\TransaccionController@getMercComision');
