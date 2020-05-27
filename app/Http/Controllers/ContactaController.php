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

        flash('Tu mensaje se ha enviado con exito')->success();

        return redirect('home');
    }

    public function getContactas(){
        $contactas = Contacta::orderBy('created_at', 'desc')->paginate(3);

        return view('listaContactas')
            ->with('contactas', $contactas);
    }

    public  function deleteContacta($id){
        $contacta = Contacta::findOrFail($id);
        $contacta->delete();

        flash('EL mensaje leido se ha borrado corectamente')->success();

        return redirect(route('getContactas'));
    }

}
