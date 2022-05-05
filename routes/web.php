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
// ENRUTAMOS LA API
Route::apiResource('apiVenta', 'ventaController');

Route::apiResource('apiPropietario','PropietarioController');
//PUNTO DE VENTA RUTAS

Route::apiResource('apiProducto','ProductoController');

Route::get('puntoventa', function () {
    return view('ventas');
});

//FIN DE RUTAS DE PUNTO DE VENTA

Route::get('mascotas', function () {
    return view('mascotas');
});

Route::get('especie', function(){
    return view('especies');
});

//RUTA DE CRUD DE PRODUCTOS
Route::get('tpro', function(){
    return view('productos');
});

//PRIMERA RUTA PARAMETRIZADA

Route::get('getRazas/{id_especie}',[
    'as' => 'getRazas',
    'uses' => 'EspecieController@getRazas',
]);

Route::get('ticket/{folio}', [
                     'as'=> 'ticket' ,
                     'uses'=>'ventaController@ticket'
                     ]);

