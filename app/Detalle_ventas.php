<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Detalle_ventas extends Model
{
    //
    protected $table='detalle_ventas';
    protected $primaryKey='id';
        protected $with=['productos'];
    public $incrementing=true;
    public $timestamps=false;

    protected $fillable=[
        'id',
        'cantidad',
        'precio',
        'total',
        'sku',
        'folio'
    ];

    public function productos(){
        return $this->belongsTo(Producto::class, 'sku', 'sku');
    }
}
