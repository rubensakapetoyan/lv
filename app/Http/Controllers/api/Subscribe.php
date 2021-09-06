<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class Subscribe extends Controller
{
    /*
     * Test Method
     * */
    public function test() {
    //https://github.com/gecche/laravel-multidomain
        return view('subscribe');
    }

}
