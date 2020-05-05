@extends('layouts.app')

@section('content')
    <a href="{{route('usuarios')}}">Volver</a>
    <h3>Editar usuario</h3>

    <form class="form" action="" method="post" enctype="multipart/form-data">
        @csrf
        {{method_field('PUT')}}
        <div class="form-group mb-2">
            <label for="edad">Email</label>
            <input type="email" class="form-control" id="mail" name="mail" value="{{ $usuario->email }}">
            @error('mail')
            <b>{{$message}}</b>
            @enderror
        </div>
        <div class="form-group mb-2">
            <label for="nombre">Nombre</label>
            <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre"
                   value="{{ $usuario->name }}">
            @error('nombre')
            <b>{{$message}}</b>
            @enderror
        </div>
        <div class="form-group mb-2">
            <label for="apellidos">Apellidos</label>
            <input type="text" class="form-control" id="apellidos" name="apellidos" placeholder="Apellidos"
                   value="{{ $usuario->apellidos }}">
            @error('apellidos')
            <b>{{$message}}</b>
            @enderror
        </div>
        <div class="form-group mb-2">
            <label for="rol">Rol</label>
            <select class="form-control" id="rol" name="rol">
                <option value="admin" @if ($usuario->rol=='admin') selected @endif>Administrador</option>
                <option value="normal" @if ($usuario->rol=='normal') selected @endif>Normal</option>
            </select>
        </div>

        <button type="submit" name="editar" value="usuario" class="btn btn-success mb-2">Editar</button>
    </form>

@endsection