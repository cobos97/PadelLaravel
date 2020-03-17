<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pista extends Model
{
    public function mensajes()
    {
        return $this->hasMany('App\Mensaje');
    }

    public function reservas()
    {
        return $this->hasMany('App\Reserva');
    }
}
