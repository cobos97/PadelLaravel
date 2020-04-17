@extends('layouts.app')

@section('content')

    <a href="{{url('/admin/complejo/' . $pista->complejo_id)}}" class="enlace">Volver</a>

    <h3>Editar pista</h3>

    <form class="form" action="" method="post" enctype="multipart/form-data">
        @csrf
        {{method_field('PUT')}}

        <div class="form-group">
            <label for="nPista">Numero de pista</label>
            <input type="text" class="form-control" id="nPista" name="nPista" value="{{$pista->nPista}}">
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
                      placeholder="Descripcion">{{ $pista->descripcion }}</textarea>
            @error('descripcion')
            <b>{{$message}}</b>
            @enderror
        </div>

        <button type="submit" name="editar" value="pista" class="btn btn-success mb-2">Editar</button>
    </form>

@endsection