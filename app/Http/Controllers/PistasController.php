<?php

namespace App\Http\Controllers;

use App\Pista;

class PistasController extends Controller
{
    public function index()
    {
        $pistas = Pista::all();

        return view('pistas.pistas')
            ->with('pistas', $pistas);
    }

    public function getPista($id)
    {
        $pista = Pista::findOrFail($id);

        return view('pistas.pista')
            ->with('pista', $pista);

    }

}
