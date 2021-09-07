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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::domain(getenv('APP_DOMAIN1'))->group(function() {
//    Route::get('posts', 'Api\PostsController@preview1');
});

Route::domain(getenv('APP_DOMAIN2'))->group(function() {
//    Route::get('posts', 'Api\PostsController@preview2');
});




Route::prefix('post/')->group(function() {
    Route::get('create', 'Api\PostsController@createPost');
});

Route::prefix('subscription/')->group(function() {
    Route::post('/', 'Api\SubscribeController@store');
});

