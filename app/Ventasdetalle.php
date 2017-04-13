<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ventasdetalle extends Model
{
    //
    protected $table = 'ventas_detalles';

    public function articulos()
        {
            return $this->belongsTo('App\Articulo');
        }

    // public function depositos()
    //     {
    //         return $this->belongsTo('App\Deposito');
    //     }



}
