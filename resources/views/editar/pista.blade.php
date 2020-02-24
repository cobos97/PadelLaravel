@extends('layouts.app')

@section('content')
    <h3>Editar pista</h3>

    <form class="form-inline" action="" method="post" enctype="multipart/form-data">
        @csrf
        {{method_field('PUT')}}
        <div class="form-group mb-2">
            <h2>{{$pista->lugar}}</h2>
            <img src="{{ asset($pista->foto)}}">
        </div>
        <div class="form-group mx-sm-3 mb-2">
            <label for="foto" class="sr-only">Foto</label>
            <input type="file" class="form-control" id="foto" name="foto">
            @error('foto')
            <b>{{$message}}</b>
            @enderror
        </div>
        <button type="submit" name="editar" value="pista" class="btn btn-success mb-2">Editar</button>
    </form>

@endsection