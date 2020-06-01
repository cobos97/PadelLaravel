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

        <span class="sr-only">{{$i = 0}}</span>

        <ul class="list-group">

            @foreach($users as $user)

                <li class="list-group-item">{{$user->name}} {{$user->apellidos}}
                    <a class="btn btn-success" href="{{url('/chat/' . $user->id)}}">Ver chat</a>
                    @if($notificaciones[$i] == 1)
                        <div class="alert alert-danger">Mensaje sin contestar en este chat</div>
                    @endif
                </li>

                {{--
                <a class="enlace" href="{{url('/chat/' . $user->id)}}">{{$user->name}} {{$user->apellidos}}</a>
                --}}

                <span class="sr-only">{{$i++}}</span>

            @endforeach

        </ul>

    @endif



@endsection
