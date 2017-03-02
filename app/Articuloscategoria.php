<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Articuloscategoria extends Model
{
    //
    protected $table = 'articuloscategorias';


    public function articulos()
        {
            return $this->hasMany('App\Articulo');
        }


}
