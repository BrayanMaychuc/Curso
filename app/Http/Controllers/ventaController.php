<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Venta;
use App\Detalle_ventas;

use DB;

class ventaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
       // Return 'hola';
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $venta = new Venta;
        $venta->folio = $request->get('folio');
        $venta->fecha_venta = $request->get('fecha_venta');
        $venta->num_articulos = $request->get('num_articulos');
        $venta->subtotal = $request->get('subtotal');
        $venta->iva = $request->get('iva');
        $venta->total = $request->get('total');

        $venta->save();

        //fin dekl manejo de venta

        //Obtenemos del request el jason de los detalles que
        // usamos en la api ventas
        $detalles=$request->get('detalles');
        // Insertamos los detalles de la venta en la base de datos
        Detalle_ventas::insert($detalles);

        // actualizacion del stock de los productos
        for ($i=0; $i <count($detalles) ; $i++) {  //hacemos un count para saber cuantos productos tenemos

            //comando para actualizar la tabla UPDATE productos SET cantidad=cantidad-$cantidadVendida WHERE sku=$productoVendido

            $cantidadVendida = $detalles[$i]['cantidad'];
            $productoVendido = $detalles[$i]['sku'];

            DB::update("UPDATE productos 
                SET cantidad=cantidad-$cantidadVendida 
                WHERE sku=$productoVendido");
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return $venta = Venta::find($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function ticket($folio){
       return  $venta= Venta::find($folio);
    }
}
