<?php

namespace App\Http\Controllers;

use App\Http\Requests\ValidationFormRequest;
use App\Mensaje;
use App\Pista;
use App\Complejo;
use App\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    //
    public function index()
    {
        return view('admin');
    }

    public function indexPistas()
    {
        $arrayPistas = Pista::all();
        return view('admin.pistas')
            ->with('arrayPistas', $arrayPistas);
    }

    public function indexComplejos()
    {

        $complejos = Complejo::all();
        return view('admin.complejos')
            ->with('complejos', $complejos);

    }

    public function indexMensajes()
    {
        $mensajes = Mensaje::all();
        $arrayPistas = Complejo::all();

        return view('admin.mensajes')
            ->with('mensajes', $mensajes)
            ->with('pistas', $arrayPistas);
    }

    public function filtroMensajes(Request $request)
    {
        $arrayPistas = Pista::all();

        $users = User::where('name', $request->input('nombre'))
            ->orWhere('name', 'like', '%' . $request->input('nombre') . '%')->get();

        $mensajes = Mensaje::where('user_id', 0)->get();

        if ($request->input('pista') != null) {
            foreach ($users as $user) {
                $aux = Mensaje::where('user_id', $user->id)->where('pista_id', $request->input('pista') * 1)->get();
                $mensajes = $mensajes->merge($aux);
            }
        } else {
            foreach ($users as $user) {
                $aux = Mensaje::where('user_id', $user->id)->get();
                $mensajes = $mensajes->merge($aux);
            }
        }


        return view('admin.mensajes')
            ->with('mensajes', $mensajes)
            ->with('pistas', $arrayPistas);
    }

    public function insertarPista(ValidationFormRequest $request)
    {
        $request->validated();


        $pista = new Pista();
        $pista->lugar = $request->input('lugar');
        $pista->direccion = $request->input('direccion');
        if ($request->input('nPista')) {
            $pista->nPista = $request->input('nPista');
        }
        $pista->descripcion = $request->input('descripcion');
        $pista->coorx = $request->input('coorx');
        $pista->coory = $request->input('coory');
        $pista->foto = 'imagenes/' . $request->file('foto')->getClientOriginalName();
        $pista->save();

        $request->file('foto')->move('imagenes', $request->file('foto')->getClientOriginalName());


        flash('Pista insertada con éxito')->success();

        return redirect('/admin/pistas');
    }

    public function getEditar($id)
    {
        $pista = Pista::findOrFail($id);

        /*
        $pista->lugar = '_' . $pista->lugar;
        $pista->save();
        */

        return view('editar.pista')
            ->with('pista', $pista);
    }

    //Preguntar con ValidatFormsREquest
    public function putEditar(ValidationFormRequest $request, $id)
    {

        $request->validated();

        $pista = Pista::findOrFail($id);

        $pista->lugar = $request->input('lugar');
        $pista->descripcion = $request->input('descripcion');
        $pista->coorx = $request->input('coorx');
        $pista->coory = $request->input('coory');

        if ($request->file('foto')) {
            $pista->foto = 'imagenes/' . $request->file('foto')->getClientOriginalName();
            $request->file('foto')->move('imagenes', $request->file('foto')->getClientOriginalName());
        }

        $pista->save();

        flash('Pista edita con éxito')->success();

        return redirect('/admin/pistas');

    }

    public function deletePista($id)
    {

        $pista = Pista::findOrFail($id);
        $pista->delete();

        flash('Pista borrada con éxito')->error();

        return redirect('/admin/pistas');

    }

    public function deleteComplejo($id)
    {

        $complejo = Complejo::findOrFail($id);
        $complejo->delete();

        flash('Complejo borrado con éxito')->error();

        return redirect('/admin/complejos');

    }


    public function deleteMensaje($id)
    {

        $mensaje = Mensaje::findOrFail($id);
        $mensaje->delete();

        flash('Mensaje borrado con éxito')->error();

        return redirect('/admin/mensajes');

    }

}
