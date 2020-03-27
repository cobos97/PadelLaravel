<?php

namespace App\Http\Controllers;

use App\Pista;
use Illuminate\Http\Request;

class ReservasController extends Controller
{
    public function index($id)
    {
        $pista = Pista::findOrFail($id);

        return view('reservas')
            ->with('pista', $pista);
    }
}
