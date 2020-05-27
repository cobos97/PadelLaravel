<?php

namespace App\Http\Controllers;

use App\Complejo;
use App\Mensaje;
use App\Pista;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MensajesController extends Controller
{
    public function index($id)
    {
        //$pistas = Pista::all();
        $mensajes = Mensaje::where('complejo_id', $id)->orderBy('created_at', 'desc')->get();
        //::orderBy('created_at', 'desc')

        $complejo = Complejo::findOrFail($id);

        return view('mensajes')
            ->with('pista_id', $id)
            ->with('complejo', $complejo)
            ->with('mensajes', $mensajes);
    }

    public function enviar(Request $request, $id){

        date_default_timezone_set('Europe/Madrid');

        $mensaje = new Mensaje();
        $mensaje->contenido = $request->input('contenido');
        //$mensaje->pista_id = $request->input('pista');
        $mensaje->complejo_id = $id;
        $mensaje->user_id = Auth()->user()->id;
        $mensaje->save();

        flash('Mensaje enviado con éxito')->success();

        return redirect('/mensajes/' . $id);
    }

    public function deleteMensaje($pista_id, $id){

        $mensaje = Mensaje::findOrFail($id);
        $mensaje->delete();

        flash('Mensaje borrado con éxito')->error();

        return redirect('/mensajes/' . $pista_id);

    }
}
