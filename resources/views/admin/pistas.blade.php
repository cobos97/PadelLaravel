@extends('layouts.app')

@section('content')

    <a href="{{route('admin')}}" class="enlace">Volver</a>

    <h2>Control de pistas</h2>

    <h3>Insertar nueva pista</h3>
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
    <h3>Listado de pistas</h3>
    <div class="row">
        @if(count($arrayPistas)==0)
            <div class="alert alert-danger">No hay pistas guardadas en el sistema</div>
        @endif
        @foreach( $arrayPistas as $pista)
            <div class="col-md-5 col-xl-3 text-center m-3">
                <img src="{{asset($pista->foto)}}" style="height:200px"/>
                <h4 style="min-height:45px;margin:5px 0 10px 0"> {{$pista->lugar}} </h4>
                <a href="{{ url('/editarPista/' . $pista->id ) }}" class="btn btn-success">Editar</a>
                <form action="{{url('/deletePista/' . $pista->id )}}" method="POST"
                      style="display:inline"> {{ method_field('DELETE') }} @csrf
                    <button type="submit" class="btn btn-danger" style="display:inline">Eliminar</button>
                </form>
            </div> @endforeach</div>

@endsection