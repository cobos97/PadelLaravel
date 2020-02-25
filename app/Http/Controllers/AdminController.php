<?php

namespace App\Http\Controllers;

use App\Http\Requests\ValidationFormRequest;
use App\Mensaje;
use App\Pista;
use App\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    //
    public function index()
    {
        $arrayPistas = Pista::all();
        $mensajes = Mensaje::all();

        return view('admin')
            ->with('arrayPistas', $arrayPistas)
            ->with('mensajes', $mensajes);
    }

    public function insertar(ValidationFormRequest $request)
    {
        switch ($request->input('insertar')) {
            case 'pista':
                $request->validated();


                $pista = new Pista();
                $pista->lugar = $request->input('lugar');
                $pista->foto = 'imagenes/' . $request->file('foto')->getClientOriginalName();
                $pista->save();

                $request->file('foto')->move('imagenes', $request->file('foto')->getClientOriginalName());

                break;
        }

        flash('Pista insertada con éxito')->success();

        return redirect('/admin');
    }

    public function getEditar($id){
        $pista = Pista::findOrFail($id);

        $pista->lugar = '_'.$pista->lugar;
        $pista->save();

        return view('editar.pista')
            ->with('pista', $pista);
    }

    //Preguntar con ValidatFormsREquest
    public function putEditar(ValidationFormRequest $request, $id){

        $request->validated();

        $pista = Pista::findOrFail($id);

        $pista->lugar = $request->input('lugar');

        if ($request->file('foto')){
            $pista->foto = 'imagenes/' . $request->file('foto')->getClientOriginalName();
            $request->file('foto')->move('imagenes', $request->file('foto')->getClientOriginalName());
        }

        $pista->save();

        flash('Pista edita con éxito')->success();

        return redirect('/admin');

    }

    public function deletePista($id){

        $pista = Pista::findOrFail($id);
        $pista->delete();

        flash('Pista borrada con éxito')->error();

        return redirect('/admin');

    }

    public function deleteMensaje($id){

        $mensaje = Mensaje::findOrFail($id);
        $mensaje->delete();

        flash('Mensaje borrado con éxito')->error();

        return redirect('/admin');

    }

}
