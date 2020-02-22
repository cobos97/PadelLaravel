<?php

namespace App\Http\Controllers;

use App\Mensaje;
use App\Pista;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MensajesController extends Controller
{
    public function index()
    {
        $pistas = Pista::all();
        $mensajes = Mensaje::all();


        return view('mensajes')
            ->with('pistas', $pistas)
            ->with('mensajes', $mensajes);
    }

    public function enviar(Request $request){
        $mensaje = new Mensaje();
        $mensaje->contenido = $request->input('contenido');
        $mensaje->pista_id = $request->input('pista');
        $mensaje->user_id = Auth()->user()->id;
        $mensaje->save();

        return redirect('/mensajes');
    }
}
