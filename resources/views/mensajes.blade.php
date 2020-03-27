@extends('layouts.app')

@section('content')

    <a href="{{route('pistas')}}" class="enlace">Volver</a>

    <form class="form" action="" method="post">
        @csrf
        <div class="row">
            <div class="col-9">
                <div class="form-group">
                    <label for="contenido" class="sr-only">Contenido</label>
                    <input type="text" class="form-control" id="contenido" name="contenido" placeholder="Envie un mensaje"
                           required>
                </div>
            </div>
            <div class="col-3">
                <button type="submit" name="enviar" value="mensaje" class="btn btn-primary mb-2">Enviar</button>
            </div>
        </div>

        {{--
        <div class="form-group mx-sm-3 mb-2">
            <label for="pista" class="sr-only">Pista</label>
            <select class="form-control" id="pista" name="pista" required>
                @foreach($pistas as $pista)
                    <option value="{{$pista->id}}">{{$pista->lugar}}</option>
                @endforeach
            </select>
        </div>
        --}}

    </form>

    {{--
    <div class="list-group">
        @foreach($mensajes as $mensaje)
            <div class="list-group-item list-group-item-action flex-column align-items-start">
                <div class="d-flex w-100 justify-content-between">
                    <h5 class="mb-1">{{$mensaje->user->name}}</h5>
                    <small>{{$mensaje->pista->created_at}}</small>
                </div>
                <p class="mb-1">{{$mensaje->contenido}}</p>
                <small>Donec id elit non mi porta.</small>
                @if (Auth()->user()->name == $mensaje->user->name)
                    <form action="{{url('/deleteMensajeUser/' . $pista_id . '/' . $mensaje->id )}}" method="POST"
                          style="display:inline"> {{ method_field('DELETE') }} @csrf
                        <button type="submit" class="btn btn-danger" style="display:inline">Borrar</button>
                    </form>
                @endif
            </div>
        @endforeach
    </div>
    --}}

    <div class="overflow-auto" style="height: 600px">

        @foreach($mensajes as $mensaje)

            @if (Auth()->user()->name != $mensaje->user->name)
                <div class="row">
                    <div class="col-9">
                        <div class="mensaje ajeno">
                            <div class="d-flex w-100 justify-content-between">
                                <h5 class="mb-1">{{$mensaje->user->name}}</h5>
                                {{--<small>{{$mensaje->created_at}}</small>--}}
                            </div>
                            <p class="mb-1">{{$mensaje->contenido}}</p>
                        </div>
                    </div>
                    <div class="col-3"></div>
                    <small class="fecha_ajeno">{{$mensaje->created_at}}</small>
                </div>
            @else
                <div class="row justify-content-end">
                    <div class="col-3"></div>
                    <div class="col-9">
                        <div class="mensaje propio">
                            <p class="mb-1">{{$mensaje->contenido}}</p>
                        </div>
                    </div>
                    <small class="fecha_propio">{{$mensaje->created_at}}</small>
                    {{--<div class="col-5">
                            <small>{{$mensaje->created_at}}</small>
                    </div>
                    --}}
                </div>
            @endif

        @endforeach

    </div>

@endsection