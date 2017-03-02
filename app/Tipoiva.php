<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tipoiva extends Model
{
    //
    protected $table = 'tipoivas';


    public function proveedors()
    {
        return $this->hasMany('App\Proveedor');
    }


}
