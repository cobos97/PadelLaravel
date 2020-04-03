<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserValidationFormRequest;
use App\User;
use Illuminate\Http\Request;

class UsuariosController extends Controller
{
    public function index()
    {
        $usuarios = User::all();

        return view('usuarios')
            ->with('usuarios', $usuarios);
    }

    public function getEditar($id){
        $usuario = User::findOrFail($id);

        return view('editar.usuario')
            ->with('usuario', $usuario);
    }

    public function putEditar(UserValidationFormRequest $request, $id){

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

    public function deleteUsuario($id){

        $usuario = User::findOrFail($id);
        $usuario->delete();

        flash('Usuario borrado con exito')->error();

        return redirect('/usuarios');

    }
}
