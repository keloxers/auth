<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comprasdetalle extends Model
{
    //
    protected $table = 'comprasdetalles';

    public function articulos()
        {
            return $this->belongsTo('App\Articulo');
        }
    public function depositos()
        {
            return $this->belongsTo('App\Deposito');
        }



}