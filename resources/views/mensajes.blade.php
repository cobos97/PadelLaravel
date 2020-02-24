@extends('layouts.app')

@section('content')
    <h1>Enviar mensaje</h1>
    <form class="form-inline" action="" method="post">
        @csrf
        <div class="form-group mb-2">
            <label for="contenido" class="sr-only">Contenido</label>
            <input type="text" class="form-control" id="contenido" name="contenido" placeholder="Escriba un mensaje"
                   required>
        </div>
        <div class="form-group mx-sm-3 mb-2">
            <label for="pista" class="sr-only">Pista</label>
            <select class="form-control" id="pista" name="pista" required>
                @foreach($pistas as $pista)
                    <option value="{{$pista->id}}">{{$pista->lugar}}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" name="enviar" value="mensaje" class="btn btn-primary mb-2">Enviar</button>
    </form>

    <h1>Listado de mensajes</h1>
    <div class="list-group">
        @foreach($mensajes as $mensaje)
            <div class="list-group-item list-group-item-action flex-column align-items-start">
                <div class="d-flex w-100 justify-content-between">
                    <h5 class="mb-1">{{$mensaje->user->name}}</h5>
                    <small>{{$mensaje->pista->lugar}}</small>
                </div>
                <p class="mb-1">{{$mensaje->contenido}}</p>
                {{--<small>Donec id elit non mi porta.</small>--}}
                @if (Auth()->user()->name == $mensaje->user->name)
                    <form action="{{url('/deleteMensajeUser/' . $mensaje->id )}}" method="POST"
                          style="display:inline"> {{ method_field('DELETE') }} @csrf
                        <button type="submit" class="btn btn-danger" style="display:inline">Borrar</button>
                    </form>
                @endif
            </div>
        @endforeach
    </div>
@endsection