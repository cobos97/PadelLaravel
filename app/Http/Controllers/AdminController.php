<?php

namespace App\Http\Controllers;

use App\Http\Requests\ValidationFormRequest;
use App\Pista;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    //
    public function index()
    {
        $arrayPistas = Pista::all();

        return view('admin')
            ->with('arrayPistas', $arrayPistas);
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

        return redirect('/admin');
    }

    public function getEditar($id){
        $pista = Pista::findOrFail($id);

        return view('editar.pista')
            ->with('pista', $pista);
    }

    //Preguntar con ValidatFormsREquest
    public function putEditar(Request $request, $id){

        $pista = Pista::findOrFail($id);

        $pista->lugar = $request->input('lugar');

        if ($request->file('fotoEditar')){
            $pista->foto = 'imagenes/' . $request->file('fotoEditar')->getClientOriginalName();
            $request->file('fotoEditar')->move('imagenes', $request->file('fotoEditar')->getClientOriginalName());
        }

        $pista->save();

        return redirect('/admin');

    }

}
