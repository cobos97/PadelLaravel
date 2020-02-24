<?php

namespace App\Http\Controllers;

use App\Contacta;
use Illuminate\Http\Request;

class ContactaController extends Controller
{
    public function index(){
        return view('contacta');
    }

    public function enviarContacta(Request $request){
        $contacta = new Contacta();
        $contacta->correo = $request->input('correo');
        $contacta->contenido = $request->input('contenido');
        $contacta->save();

        return redirect('home');
    }

    public function getContactas(){
        $contactas = Contacta::orderBy('created_at', 'desc')->get();

        return view('listaContactas')
            ->with('contactas', $contactas);
    }

    public  function deleteContacta($id){
        $contacta = Contacta::findOrFail($id);
        $contacta->delete();

        return redirect(route('getContactas'));
    }

}
