<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Propietario extends Model 
{
    protected $table='propietarios';
    protected $primaryKey='id_propietario';
    public $with=['mascotas'];

    public $incrementig=true;
    public $timestamps=false;

    public $filliable=[
    'id_propietario',
    'nombre',
    'primer_apellido',
    'segundo_apellido',
    'genero'
    ];

    //Relacion hasMany o uno a varios
    
    public function mascotas()
    {
        return $this->hasMany(Mascota::class, 'id_propietario','id_propietario');
    }
}
