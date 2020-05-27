@extends('layouts.app')

@section('content')

    <a href="{{url('/admin')}}" class="enlace">Volver</a>

    <h1>Abrir nuevo chat</h1>

    <form class="form" action="" method="post">
        @csrf
        <div class="row">

            <div class="col-4">

                <label for="contenido">Elige un nuevo usuario de la lista</label>

            </div>

            <div class="col-5">
                <select type="text" class="form-control" id="usuario" name="usuario"
                        required>
                    @foreach($usuarios as $usuario)
                        <option value="{{$usuario->id}}">{{$usuario->name}} {{$usuario->apellidos}}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-3">
                <button type="submit" name="enviar" value="mensaje" class="btn btn-primary mb-2">Abrir</button>
            </div>
        </div>

    </form>


    <h1>Chats abiertos</h1>

    @if(count($users)==0)
        <div class="alert alert-danger">No tienes mensajes de chat con ningun usuario del sistema</div>
    @else

        @foreach($users as $user)

            <a class="enlace" href="{{url('/chat/' . $user->id)}}">{{$user->name}} {{$user->apellidos}}</a><br>

        @endforeach

    @endif



@endsection
