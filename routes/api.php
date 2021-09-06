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

Route::domain(getenv('APP_DOMAIN1'))->group(function() {

});

Route::domain(getenv('APP_DOMAIN2'))->group(function() {

    Route::resource('/subscribe', 'Api\SubscribeController');

});

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
