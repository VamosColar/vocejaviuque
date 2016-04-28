<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('convenios', function() {
    $convenios = new \Vjvq\Convenios\Convenios();
    return response()->json($convenios->save());
});

Route::get('ola-mundo', function () {
    echo 'Hello World';
});
