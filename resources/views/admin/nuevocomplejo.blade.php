@extends('layouts.app')

@section('content')

    <a href="{{route('complejosAdmin')}}" class="enlace">Volver</a>

    <h1>Añade un nuevo complejo al sistema</h1>
    <form class="form" action="" method="post" enctype="multipart/form-data">
        @csrf

        <div class="form-group">
            <label for="lugar" class="sr-only">Lugar</label>
            <input type="text" class="form-control" id="lugar" name="lugar" placeholder="Lugar"
                   value="{{ old('lugar') }}">
            @error('lugar')
            <b>{{$message}}</b>
            @enderror
        </div>
        <div class="form-group">
            <label for="direccion" class="sr-only">Direccion</label>
            <input type="text" class="form-control" id="direccion" name="direccion" placeholder="Direccion"
                   value="{{ old('direccion') }}">
            @error('direccion')
            <b>{{$message}}</b>
            @enderror
        </div>
        <div class="form-group">
            <label for="foto" class="sr-only">Foto</label>
            <input type="file" class="form-control" id="foto" name="foto" value="{{ old('foto') }}" required>
            @error('foto')
            <b>{{$message}}</b>
            @enderror
        </div>
        <div class="form-group">
            <label for="descripcion" class="sr-only">Descripcion</label>
            <textarea type="text" class="form-control" id="descripcion" name="descripcion"
                      placeholder="Descripcion">{{ old('descripcion') }}</textarea>
            @error('descripcion')
            <b>{{$message}}</b>
            @enderror
        </div>
        <div class="form-group">
            <label for="coorx" class="sr-only">Coordenada x</label>
            <input type="text" class="form-control" id="coorx" name="coorx" placeholder="Coordenada x"
                   value="{{ old('coorx') }}" required>
        </div>
        <div class="form-group">
            <label for="coory" class="sr-only">Coordenada x</label>
            <input type="text" class="form-control" id="coory" name="coory" placeholder="Coordenada y"
                   value="{{ old('coory') }}" required>
        </div>
        <button type="submit" name="insertar" value="pista" class="btn btn-primary mb-2">Insertar</button>
    </form>

@endsection