<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::domain(getenv('APP_DOMAIN1'))->group(function() {

});

Route::domain(getenv('APP_DOMAIN2'))->group(function() {
    Route::get('/test', 'api\Subscribe@test');

    Route::get('/abc', function(){
        return 'asdasdasf';
    });
});


Route::get('/', function () {
    return view('welcome');
});

