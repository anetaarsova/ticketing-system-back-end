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

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::middleware('client_credentials')->post('/oauth/token', 'ApiTokenController@issueToken')->name('token');

Route::middleware(['auth:api', 'client_credentials'])->group(function () {
    Route::resource('users', 'User');
    Route::get('users?role{user|admin}', 'User@index');
    Route::resource('tickets', 'TicketController');
});

