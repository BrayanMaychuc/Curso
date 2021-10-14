<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Especie extends Model
{
    protected $table = 'especies';
    protected $primaryKey = 'id_especie';


    // Define si la llave primaria es o no un numero autoincrementable 

    public $incrementing=true;
    
    //Activar o desactivar etiquetas de tiempo
    
    public $timestamps=false;

    public $filliable=[
        'id_especie',
        'especie',
        'id_mascota'
    ];

}
