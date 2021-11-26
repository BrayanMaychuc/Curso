<?php

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

Route::get('/', function () {
    return view('welcome');
});
Route::apiResource('apiMascota','MascotaController');
Route::apiResource('apiEspecie','EspecieController');

Route::apiResource('apiPropietario','PropietarioController');
//PUNTO DE VENTA RUTAS

Route::apiResource('apiProducto','ProductoController');

Route::get('mascotas', function () {
    return view('mascotas');
});

Route::get('especie', function(){
    return view('especies');
});

//PRIMERA RUTA PARAMETRIZADA

Route::get('getRazas/{id_especie}',[
    'as' => 'getRazas',
    'uses' => 'EspecieController@getRazas',
]);

