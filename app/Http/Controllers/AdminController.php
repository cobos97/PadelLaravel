<?php

namespace App\Http\Controllers;

use App\Http\Requests\ValidationFormRequest;
use App\Http\Requests\ValidationFormRequestPista;
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

    public function indexNuevoComplejo()
    {

        return view('admin.nuevocomplejo');

    }

    public function getComplejo($id)
    {

        $complejo = Complejo::findOrFail($id);
        $pistas = Pista::where('complejo_id', '=', $id)->get();

        return view('admin.complejo')
            ->with('complejo', $complejo)
            ->with('pistas', $pistas);

    }

    public function indexNuevaPista($id)
    {

        $complejo = Complejo::findOrFail($id);

        return view('admin.nuevapista')
            ->with('complejo', $complejo);

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

    public function insertarComplejo(ValidationFormRequest $request)
    {

        $request->validated();

        $complejo = new Complejo();
        $complejo->lugar = $request->input('lugar');
        $complejo->direccion = $request->input('direccion');
        $complejo->descripcion = $request->input('descripcion');
        $complejo->coorx = $request->input('coorx');
        $complejo->coory = $request->input('coory');
        $complejo->foto = 'imagenes/' . $request->file('foto')->getClientOriginalName();
        $complejo->save();

        $request->file('foto')->move('imagenes', $request->file('foto')->getClientOriginalName());


        flash('Complejo insertado con éxito')->success();

        return redirect('/admin/complejos');


    }

    public function insertarPista(ValidationFormRequestPista $request)
    {
        $request->validated();


        $pista = new Pista();

        $pista->complejo_id = $request->input('id_complejo');

        $posiblesPistas = Pista::where('complejo_id', '=', $request->input('id_complejo'))->get();
        $pista->nPista = count($posiblesPistas) + 1;

        $pista->descripcion = $request->input('descripcion');

        $pista->foto = 'imagenes/' . $request->file('foto')->getClientOriginalName();
        $pista->save();

        $request->file('foto')->move('imagenes', $request->file('foto')->getClientOriginalName());


        flash('Pista insertada con éxito')->success();

        return redirect('/admin/complejo/' . $request->input('id_complejo'));
    }


    public function getEditarComplejo($id)
    {
        $complejo = Complejo::findOrFail($id);

        /*
        $pista->lugar = '_' . $pista->lugar;
        $pista->save();
        */

        return view('editar.complejo')
            ->with('complejo', $complejo);
    }

    public function putEditarComplejo(ValidationFormRequest $request)
    {

        $request->validated();

        $complejo = Complejo::findOrFail($request->input('complejo_id'));

        $complejo->lugar = $request->input('lugar');
        $complejo->direccion = $request->input('direccion');
        $complejo->descripcion = $request->input('descripcion');
        $complejo->coorx = $request->input('coorx');
        $complejo->coory = $request->input('coory');

        if ($request->file('foto')) {
            $complejo->foto = 'imagenes/' . $request->file('foto')->getClientOriginalName();
            $request->file('foto')->move('imagenes', $request->file('foto')->getClientOriginalName());
        }

        $complejo->save();

        flash('Complejo editado con éxito')->success();

        return redirect('/admin/complejo/' . $request->input('complejo_id'));

    }

    public function getEditarPista($id)
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
    public function putEditarPista(ValidationFormRequestPista $request, $id)
    {

        $request->validated();

        $pista = Pista::findOrFail($id);

        $pista->nPista = $request->input('nPista');

        $pista->descripcion = $request->input('descripcion');

        if ($request->file('foto')) {
            $pista->foto = 'imagenes/' . $request->file('foto')->getClientOriginalName();
            $request->file('foto')->move('imagenes', $request->file('foto')->getClientOriginalName());
        }

        $pista->save();

        flash('Pista edita con éxito')->success();

        return redirect('/admin/complejo/' . $pista->complejo_id);

    }

    public function deletePista($id)
    {

        $pista = Pista::findOrFail($id);
        $complejo = $pista->complejo_id;
        $pista->delete();

        flash('Pista borrada con éxito')->error();

        return redirect('/admin/complejo/' . $complejo);

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
