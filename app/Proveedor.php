<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Proveedor extends Model
{
    //
    protected $table = 'proveedors';

    public function tipoivas()
        {
            return $this->belongsTo('App\Tipoiva');
        }

    public function compras()
        {
            return $this->hasMany('App\Compra');
        }

}
