@extends('layouts.app')

@section('content')

    <a href="{{url('/admin/complejo/' . $complejo->id)}}" class="enlace">Volver</a>

    <h1>Añade una nueva pista a {{$complejo->lugar}}, {{$complejo->direccion}}</h1>

    <form class="form" action="" method="post" enctype="multipart/form-data">
        @csrf

        <input name="id_complejo" value="{{$complejo->id}}" hidden>

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
        <button type="submit" name="insertar" value="pista" class="btn btn-primary mb-2">Insertar</button>
    </form>

@endsection