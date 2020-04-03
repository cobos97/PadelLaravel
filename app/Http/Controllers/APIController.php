<?php

namespace App\Http\Controllers;

use App\Mensaje;
use App\Pista;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use PDOException;

class APIController extends Controller
{
    public function getUsuarios()
    {
        return response()->json(User::all());
    }

    public function storeUsuario(Request $request)
    {
        try {
            //return response()->json(['error' => false, 'msg' => 'El usuario se ha guardado correctamente']);

            if ($request->input('nombre') && $request->input('apellidos') &&
                $request->input('correo') && $request->input('edad') &&
                $request->input('contrasena')) {
                $user = new User();
                $user->email = $request->input('correo');
                $user->name = $request->input('nombre');
                $user->apellidos = $request->input('apellidos');
                $user->edad = $request->input('edad');
                $user->password = Hash::make($request->input('contrasena'));
                $user->save();
                return response()->json(['error' => false, 'msg' => 'El usuario se ha guardado correctamente']);
            } else {
                return response()->json(['error' => true, 'msg' => 'Faltan parametros']);
            }
        } catch (PDOException $e) {
            return response()->json(['error' => true, 'msg' => $e->getMessage()]);
        }
    }

    public function putUsuario(Request $request, $id)
    {
        try {
            $usuario = User::findOrFail($id);
            if ($request->input('nombre')) $usuario->name = $request->input('nombre');
            if ($request->input('apellidos')) $usuario->apellidos = $request->input('apellidos');
            if ($request->input('correo')) $usuario->email = $request->input('correo');
            if ($request->input('edad')) $usuario->edad = $request->input('edad');
            if ($request->input('contrasena')) $usuario->password = Hash::make($request->input('contrasena'));
            $usuario->save();
            return response()->json(['error' => false, 'msg' => 'El usuario se ha actualizado correctamente']);
        } catch (PDOException $e) {
            return response()->json(['error' => true, 'msg' => $e->getMessage()]);
        }

    }

    public function deleteUsuario($id)
    {
        if ($usuario = User::find($id)) {
            $usuario->delete();
            return response()->json(['error' => false, 'msg' => 'El usuario se ha borrado correctamente']);
        } else {
            return response()->json(['error' => true, 'msg' => 'El usuario indicado no existe']);
        }
    }


    public function getPistas()
    {
        return response()->json(Pista::all());
    }

    public function getMensajes()
    {
        return response()->json(Mensaje::all());
    }
}
