<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Compra extends Model
{
    //
    protected $table = 'compras';


    public function proveedors()
    {
        return $this->belongsTo('App\Proveedor');
    }


}
