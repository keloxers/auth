<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Articulo extends Model
{
    //
    protected $table = 'articulos';


    public function articuloscategorias()
    {
        return $this->belongsTo('App\Articuloscategoria');
    }

    public function comprasdetalles()
    {
        return $this->hasMany('App\Comprasdetalle');
    }

}
