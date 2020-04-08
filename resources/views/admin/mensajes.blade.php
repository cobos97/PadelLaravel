@extends('layouts.app')

@section('content')

    <a href="{{route('admin')}}" class="enlace">Volver</a>

    <h1>Control de mensajes</h1>

    <h2>Filtra los mensajes</h2>
    <form class="form" action="" method="post" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="nombre" class="sr-only">Nombre</label>
            <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre">
        </div>
        <div class="form-group">
            <label for="pista" class="sr-only">Pista</label>
            <select class="form-control" id="pista" name="pista">
                <option value="">Seleccione una pista si lo desea</option>
                @foreach($pistas as $pista)
                    <option value="{{$pista->id}}">{{$pista->lugar}}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" name="filtrar" value="usuario" class="btn btn-success mb-2">Filtrar</button>
    </form>

    <table class="table table-striped">
        <thead>
        <tr>
            <th scope="col">Emisor</th>
            <th scope="col">Contenido</th>
            <th scope="col">Lugar</th>
            <th scope="col"></th>
        </tr>
        </thead>
        <tbody>
        @if(count($mensajes)==0)
            <div class="alert alert-danger">No hay mensajes guardados en el sistema</div>
        @endif
        @foreach($mensajes as $mensaje)
            <tr>
                <th scope="row">{{$mensaje->user->name}}</th>
                <td>{{$mensaje->contenido}}</td>
                <td>{{$mensaje->pista->lugar}}, {{$mensaje->pista->direccion}}-{{$mensaje->pista->nPista}}</td>
                <td>
                    <form action="{{url('/deleteMensaje/' . $mensaje->id )}}" method="POST"
                          style="display:inline"> {{ method_field('DELETE') }} @csrf
                        <button type="submit" class="btn btn-danger" style="display:inline">Borrar</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

@endsection
