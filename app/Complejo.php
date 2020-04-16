<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Complejo extends Model
{
    public function pistas()
    {
        return $this->hasMany('App\Pista');
    }
    public function mensajes()
    {
        return $this->hasMany('App\Mensaje');
    }
}
