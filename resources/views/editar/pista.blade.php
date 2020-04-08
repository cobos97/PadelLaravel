@extends('layouts.app')

@section('content')

    <a href="{{route('pistasAdmin')}}" class="enlace">Volver</a>

    <h3>Editar pista</h3>

    <form class="form" action="" method="post" enctype="multipart/form-data">
        @csrf
        {{method_field('PUT')}}
        <div class="form-group">
            <label for="lugar" class="sr-only">Lugar</label>
            <input type="text" name="lugar" id="lugar" class="form-control" value="{{$pista->lugar}}">
            @error('lugar')
            <b>{{$message}}</b>
            @enderror
        </div>
        <div class="form-group">
            <label for="direccion" class="sr-only">Direccion</label>
            <input type="text" class="form-control" id="direccion" name="direccion" value="{{$pista->direccion}}">
            @error('direccion')
            <b>{{$message}}</b>
            @enderror
        </div>
        <div class="form-group">
            <label for="nPista" class="sr-only">Numero de pista</label>
            <input type="text" class="form-control" id="nPista" name="nPista" value="{{$pista->nPista}}">
        </div>
        <div class="form-group">
            <label for="foto" class="sr-only">Foto</label>
            <input type="file" class="form-control" id="foto" name="foto">
            @error('foto')
            <b>{{$message}}</b>
            @enderror
        </div>
        <div class="form-group">
            <label for="descripcion" class="sr-only">Descripcion</label>
            <textarea type="text" class="form-control" id="descripcion" name="descripcion"
                      placeholder="Descripcion">{{ $pista->descripcion }}</textarea>
            @error('descripcion')
            <b>{{$message}}</b>
            @enderror
        </div>
        <div class="form-group">
            <label for="coorx" class="sr-only">Coordenada x</label>
            <input type="text" class="form-control" id="coorx" name="coorx"
                   value="{{ $pista->coorX }}" required>
        </div>
        <div class="form-group">
            <label for="coory" class="sr-only">Coordenada x</label>
            <input type="text" class="form-control" id="coory" name="coory"
                   value="{{ $pista->coorY }}" required>
        </div>
        <button type="submit" name="editar" value="pista" class="btn btn-success mb-2">Editar</button>
    </form>

@endsection