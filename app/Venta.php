<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
    //
    protected $table = 'ventas';


    public function clientes()
    {
        return $this->belongsTo('App\Cliente');
    }

    public function condicionesventas()
    {
        return $this->belongsTo('App\Condicionesventa');
    }


}
