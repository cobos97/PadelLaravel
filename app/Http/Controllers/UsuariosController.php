<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserValidationFormRequest;
use App\User;
use Illuminate\Http\Request;

class UsuariosController extends Controller
{
    public function index()
    {

        date_default_timezone_set('Europe/Madrid');

        $usuarios = User::all();

        return view('usuarios')
            ->with('usuarios', $usuarios);
    }

    public function getFiltro(Request $request)
    {

        date_default_timezone_set('Europe/Madrid');

        $usuarios = User::where('email', $request->input('nombre'))
            ->orWhere('email', 'like', '%' . $request->input('nombre') . '%')->get();

        return view('usuarios')
            ->with('usuarios', $usuarios);

    }

    public function getEditar($id)
    {
        $usuario = User::findOrFail($id);

        return view('editar.usuario')
            ->with('usuario', $usuario);
    }

    public function putEditar(UserValidationFormRequest $request, $id)
    {

        $request->validated();

        $usuario = User::findOrFail($id);

        $usuario->name = $request->input('nombre');
        $usuario->apellidos = $request->input('apellidos');
        $usuario->edad = $request->input('edad');
        $usuario->rol = $request->input('rol');

        $usuario->save();

        flash('Usuario editado con exito')->success();

        return redirect('/usuarios');

    }

    public function putPenalizar(Request $request, $id)
    {
        date_default_timezone_set('Europe/Madrid');

        $usuario = User::findOrFail($id);
        $usuario->penalizacion = time() + $request->input('dias') * 3600 * 24;

        $usuario->save();

        flash('El usuario a sido penalizado con exito')->success();

        return redirect('/usuarios');
    }

    public function putDespenalizar(Request $request, $id)
    {
        date_default_timezone_set('Europe/Madrid');

        $usuario = User::findOrFail($id);
        $usuario->penalizacion = '1';

        $usuario->save();

        flash('El usuario vuelve a estar activo')->success();

        return redirect('/usuarios');
    }

    public function deleteUsuario($id)
    {

        $usuario = User::findOrFail($id);
        $usuario->delete();

        flash('Usuario borrado con exito')->error();

        return redirect('/usuarios');

    }
}
