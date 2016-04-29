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

Route::get('convenios', function () {
    $convenios = new \Vjvq\Importacao\Convenios\Convenios();
    return response()->json($convenios->save());
});

Route::get('todos-convenios', function (\Illuminate\Http\Request $request) {
    $nConvenios = new \Vjvq\Consultas\Convenio();

    var_dump($nConvenios->all($request->all()));
});

Route::get('municipios', function () {
    $municipios = new \Vjvq\Importacao\Proponentes\Municipios();
    return response()->json($municipios->save());
});

Route::get('programas', function () {
    $programas = new \Vjvq\Importacao\Programas\Programas();
    return response()->json($programas->save());
});
