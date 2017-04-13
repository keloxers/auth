<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{

    protected $table = 'clientes';

    public function barrios()
    {
        return $this->belongsTo('App\Barrio');
    }

    public function compras()
        {
            return $this->hasMany('App\Compra');
        }
        
}
