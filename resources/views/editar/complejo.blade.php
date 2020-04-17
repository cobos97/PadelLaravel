@extends('layouts.app')

@section('content')

    <a href="{{url('/admin/complejo/' . $complejo->id)}}" class="enlace">Volver</a>

    <h3>Editar complejo</h3>

    <form class="form" action="" method="post" enctype="multipart/form-data">
        @csrf
        {{method_field('PUT')}}

        <input name="complejo_id" value="{{$complejo->id}}" hidden>

        <div class="form-group">
            <label for="lugar">Lugar</label>
            <input type="text" name="lugar" id="lugar" class="form-control" value="{{$complejo->lugar}}">
            @error('lugar')
            <b>{{$message}}</b>
            @enderror
        </div>
        <div class="form-group">
            <label for="direccion">Direccion</label>
            <input type="text" class="form-control" id="direccion" name="direccion" value="{{$complejo->direccion}}">
            @error('direccion')
            <b>{{$message}}</b>
            @enderror
        </div>
        <div class="form-group">
            <label for="foto">Foto</label>
            <input type="file" class="form-control" id="foto" name="foto">
            @error('foto')
            <b>{{$message}}</b>
            @enderror
        </div>
        <div class="form-group">
            <label for="descripcion">Descripcion</label>
            <textarea type="text" class="form-control" id="descripcion" name="descripcion"
                      placeholder="Descripcion">{{ $complejo->descripcion }}</textarea>
            @error('descripcion')
            <b>{{$message}}</b>
            @enderror
        </div>
        <div class="form-group">
            <label for="coorx">Coordenada x</label>
            <input type="text" class="form-control" id="coorx" name="coorx"
                   value="{{ $complejo->coorX }}" required>
        </div>
        <div class="form-group">
            <label for="coory">Coordenada x</label>
            <input type="text" class="form-control" id="coory" name="coory"
                   value="{{ $complejo->coorY }}" required>
        </div>
        <button type="submit" name="editar" value="pista" class="btn btn-success mb-2">Editar</button>
    </form>

@endsection