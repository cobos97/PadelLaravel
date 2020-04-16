<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pista extends Model
{
    public function reservas()
    {
        return $this->hasMany('App\Reserva');
    }

    public function complejo()
    {
        return $this->belongsTo('App\Complejo');
    }
}
