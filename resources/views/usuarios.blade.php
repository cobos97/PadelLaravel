@extends('layouts.app')

@section('content')
    <a href="{{route('admin')}}">Volver</a>
    <h1>Control de usuarios</h1>

    <h2>Control de usuarios</h2>
    <table class="table table-striped">
        <thead>
        <tr>
            <th scope="col">Nombre</th>
            <th scope="col">Correo</th>
            <th scope="col">Apellidos</th>
            <th scope="col">Edad</th>
            <th scope="col">Rol</th>
            <th scope="col">Verificado</th>
            <th scope="col"></th>
            <th scope="col"></th>
        </tr>
        </thead>
        <tbody>
        @foreach($usuarios as $usuario)
            <tr>
                <th scope="row">{{$usuario->email}}</th>
                <td>{{$usuario->name}}</td>
                <td>{{$usuario->apellidos}}</td>
                <td>{{$usuario->edad}}</td>
                <td>{{$usuario->rol}}</td>
                <td>{{$usuario->email_verified_at}}</td>
                <td>
                    <a href="{{ url('/editarUsuario/' . $usuario->id ) }}" class="btn btn-success">Editar</a>
                </td>
                <td>
                    <form action="{{url('/deleteUsuario/' . $usuario->id )}}" method="POST"
                          style="display:inline"> {{ method_field('DELETE') }} @csrf
                        <button type="submit" class="btn btn-danger" style="display:inline">Borrar</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>


@endsection