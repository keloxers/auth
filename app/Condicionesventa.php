<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Condicionesventa extends Model
{
    //
    protected $table = 'condicionesventas';


    public function ventas()
        {
            return $this->hasMany('App\Venta');
        }


}
