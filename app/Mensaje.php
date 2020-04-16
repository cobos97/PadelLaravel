<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mensaje extends Model
{
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function complejo()
    {
        return $this->belongsTo('App\Complejo');
    }
}
