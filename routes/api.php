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

Route::group([
    'prefix' => 'auth'
], function () {
    Route::post('login', 'AuthController@login');
    Route::post('register', 'AuthController@register');

    Route::group([
        'middleware' => 'auth:api'
    ], function() {
        Route::get('logout', 'AuthController@logout');
        Route::get('user', 'AuthController@user');
    });
});

//Route::middleware('client_credentials')->post('/oauth/token', 'ApiTokenController@issueToken')->name('token');
//'client_credentials'
//'cors'
Route::middleware(['auth:api'])->group(function () {
    Route::resource('users', 'User');
    Route::get('users?role{user|admin}', 'User@index');
    Route::resource('tickets', 'TicketController');
    Route::get('tickets/user/{userId}', 'TicketController@getTicketsByUser');
});

