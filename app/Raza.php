<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Raza extends Model
{
    /protected $table = 'razas';
    protected $primaryKey = 'id_raza';


    // Define si la llave primaria es o no un numero autoincrementable 

    public $incrementing=true;
    
    //Activar o desactivar etiquetas de tiempo
    
    public $timestamps=false;

    public $filliable=[
        'id_raza',
        'raza',
        'id_mascota'
    ];
}
