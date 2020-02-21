@extends('layouts.app')

@section('content')
    <h3>Editar pista</h3>

    <form class="form-inline" action="" method="post" enctype="multipart/form-data">
        @csrf
        {{method_field('PUT')}}
        <div class="form-group mb-2">
            <label for="lugar" class="sr-only">Lugar</label>
            <input type="text" class="form-control" id="lugar" name="lugar" placeholder="Lugar" value="{{ $pista->lugar }}">
            {{--
            @error('lugar')
            <b>{{$message}}</b>
            @enderror
            --}}
        </div>
        <div class="form-group mx-sm-3 mb-2">
            <label for="foto" class="sr-only">Foto</label>
            <input type="file" class="form-control" id="foto" name="foto">
        </div>
        <button type="submit" name="editar" value="pista" class="btn btn-success mb-2">Editar</button>
    </form>

@endsection