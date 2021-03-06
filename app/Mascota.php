<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mascota extends Model
{
    protected $table='mascotas';
    protected $primaryKey='id_mascota';

    //especificamos las relaciones

    public $with=['especie'];

    // Define si la llave primaria es o no un numero autoincrementable 

    public $incrementing=true;
    
    //Activar o desactivar etiquetas de tiempo
    
    public $timestamps=false;

    public $filliable=[
        'id_mascota',
        'nombre',
        'peso',
        'genero',
        'id_especie',
        'id_propietario',
    ];
    //relacion belongsTo
    // Relacion Uno a Uno
    public function especie()
    {
        return $this->belongsTo(Especie::class, 'id_especie', 'id_especie');
    }
}
