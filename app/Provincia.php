<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Provincia extends Model
{
    //
    protected $table = 'provincias';


    public function ciudads()
        {
            return $this->hasMany('App\Ciudad');
        }


}
