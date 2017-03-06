<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Deposito extends Model
{
    //
    protected $table = 'depositos';

    public function comprasdetalles()
    {
        return $this->hasMany('App\Comprasdetalle');
    }


}
