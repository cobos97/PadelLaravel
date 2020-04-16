@extends('layouts.app')

@section('content')

    <a href="{{route('admin')}}" class="enlace">Volver</a>

    <h2>Control de pistas</h2>

    {{--
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
                <label for="direccion" class="sr-only">Direccion</label>
                <input type="text" class="form-control" id="direccion" name="direccion" placeholder="Direccion"
                       value="{{ old('direccion') }}">
                @error('direccion')
                <b>{{$message}}</b>
                @enderror
            </div>
            <div class="form-group">
                <label for="nPista" class="sr-only">Numero de pista</label>
                <input type="text" class="form-control" id="nPista" name="nPista" placeholder="Número de pista">
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

--}}

    <h3>Listado de pistas</h3>
    <div class="row">
        @if(count($arrayPistas)==0)
            <div class="alert alert-danger">No hay pistas guardadas en el sistema</div>
        @endif
        @foreach( $arrayPistas as $pista)
            <div class="col-md-5 col-xl-3 text-center m-3">
                <img src="{{asset($pista->foto)}}" style="height:200px"/>
                <h4 style="min-height:45px;margin:5px 0 10px 0"> {{$pista->lugar}}<br>{{$pista->direccion}}
                    - {{$pista->nPista}} </h4>
                <a href="{{ url('/editarPista/' . $pista->id ) }}" class="btn btn-success">Editar</a>
                {{--
                <form action="{{url('/deletePista/' . $pista->id )}}" method="POST"
                      style="display:inline"> {{ method_field('DELETE') }} @csrf
                    <button type="submit" class="btn btn-danger" style="display:inline">Eliminar</button>
                </form>
                --}}
                <button id="cancelar" type="button" class="btn btn-danger" data-toggle="modal"
                        data-target="#delexampleModal" onclick="event.preventDefault();
                        document.getElementById('formDel').setAttribute('action', '{{url('/deletePista/' . $pista->id )}}');">
                    Eliminar
                </button>
            </div> @endforeach</div>

    <!-- Modal -->
    <div class="modal fade" id="delexampleModal" tabindex="-1" role="dialog" aria-labelledby="delexampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">¿Estás seguro que quieres eliminar esta pista?</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Al borrar la pista se borrarán todas sus reservas y mensajes también.<br>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <form id="formDel" action="{{url('/deletePista/' . $pista->id )}}" method="POST"
                          style="display:inline"> {{ method_field('DELETE') }} @csrf
                        <button type="submit" class="btn btn-danger" style="display:inline">Borrar pista</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection