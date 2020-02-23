@extends('layouts.app')

@section('content')
    <h1>Zona de administración</h1>

    <a href="{{route('usuarios')}}">Control de usuarios</a>

    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home"
               aria-selected="true">Pistas</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile"
               aria-selected="false">Mensajes</a>
        </li>
    </ul>
    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">

            <h2>Control de pistas</h2>

            <h3>Insertar nueva pista</h3>
            <form class="form-inline" action="" method="post" enctype="multipart/form-data">
                @csrf

                <div class="form-group mb-2">
                    <label for="lugar" class="sr-only">Lugar</label>
                    <input type="text" class="form-control" id="lugar" name="lugar" placeholder="Lugar"
                           value="{{ old('lugar') }}">
                    @error('lugar')
                    <b>{{$message}}</b>
                    @enderror
                </div>
                <div class="form-group mx-sm-3 mb-2">
                    <label for="foto" class="sr-only">Foto</label>
                    <input type="file" class="form-control" id="foto" name="foto" value="{{ old('foto') }}" required>
                    @error('foto')
                    <b>{{$message}}</b>
                    @enderror
                </div>
                <button type="submit" name="insertar" value="pista" class="btn btn-primary mb-2">Insertar</button>
            </form>
            <h3>Listado de pistas</h3>
            <div class="row"> @foreach( $arrayPistas as $pista)
                    <div class="col-xs-6 col-sm-4 col-md-3 text-center m-3">
                        <img src="{{$pista->foto}}" style="height:200px"/>
                        <h4 style="min-height:45px;margin:5px 0 10px 0"> {{$pista->lugar}} </h4>
                        <a href="{{ url('/editarPista/' . $pista->id ) }}" class="btn btn-success">Editar</a>
                        <form action="{{url('/deletePista/' . $pista->id )}}" method="POST"
                              style="display:inline"> {{ method_field('DELETE') }} @csrf
                            <button type="submit" class="btn btn-danger" style="display:inline">Eliminar</button>
                        </form>
                    </div> @endforeach</div>
        </div>

        <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
            <h2>Control de mensajes</h2>
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
                @foreach($mensajes as $mensaje)
                    <tr>
                        <th scope="row">{{$mensaje->user->name}}</th>
                        <td>{{$mensaje->contenido}}</td>
                        <td>{{$mensaje->pista->lugar}}</td>
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
        </div>
    </div>

@endsection