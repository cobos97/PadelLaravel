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

        $usuarios = User::all();
        foreach ($usuarios as $u) {
            $correos[] = $u->email;
        }

        $usuario->name = $request->input('nombre');
        $usuario->apellidos = $request->input('apellidos');
        $usuario->rol = $request->input('rol');

        flash('Usuario editado con exito')->success();

        if (strcmp($usuario->email, $request->input('mail'))) {

            if (!in_array($request->input('mail'), $correos)) {
                $usuario->email = $request->input('mail');
                $usuario->email_verified_at = null;

            } else {
                flash('Ese correo ya pertenece a otro usuario.')->error();

                $usuario->save();
                return redirect('/editarUsuario/' . $usuario->id);
            }

        }

        $usuario->save();

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
