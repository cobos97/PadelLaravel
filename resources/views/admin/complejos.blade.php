@extends('layouts.app')

@section('content')

    <a href="{{route('admin')}}" class="enlace">Volver</a>

    <h1>Control de complejos</h1>

    <a href="{{route('nuevocomplejo')}}" class="enlace">Añadir un nuevo complejo deportivo</a>

    <h3>Listado de complejos</h3>
    <div class="row">
        @if(count($complejos)==0)
            <div class="alert alert-danger">No hay complejos guardados en el sistema</div>
        @endif
        @foreach( $complejos as $complejo)

            <div class="card col-md-5 col-xl-3 m-3" style="padding: 0;">
                <img class="card-img-top" src="{{asset($complejo->foto)}}" style="width: 100%; height:200px"
                     alt="Card image">
                <div class="card-body">
                    <h4 class="card-title">{{$complejo->lugar}}</h4>
                    <p class="card-text">{{$complejo->direccion}}</p>
                    <a href="{{url('/admin/complejo/' . $complejo->id)}}" class="btn btn-success"
                       style="color: white">Editar</a>
                    <button id="cancelar" type="button" class="btn btn-danger" data-toggle="modal"
                            data-target="#delexampleModal" onclick="event.preventDefault();
                            document.getElementById('formDel').setAttribute('action', '{{url('/deleteComplejo/' . $complejo->id )}}');">
                        Eliminar
                    </button>
                </div>
            </div>
            {{--
            <div class="col-md-5 col-xl-3 text-center m-3">
                <img src="{{asset($complejo->foto)}}" style="width: 100%; height:200px"/>
                <h4 style="min-height:45px;margin:5px 0 10px 0"> {{$complejo->lugar}}<br>{{$complejo->direccion}}</h4>
                <a href="{{url('/admin/complejo/' . $complejo->id)}}" class="btn btn-success"
                   style="color: white">Editar</a>

                <button id="cancelar" type="button" class="btn btn-danger" data-toggle="modal"
                        data-target="#delexampleModal" onclick="event.preventDefault();
                        document.getElementById('formDel').setAttribute('action', '{{url('/deleteComplejo/' . $complejo->id )}}');">
                    Eliminar
                </button>
            </div> --}}

        @endforeach

    </div>




    <!-- Modal -->
    <div class="modal fade" id="delexampleModal" tabindex="-1" role="dialog" aria-labelledby="delexampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">¿Estás seguro que quieres eliminar este
                        complejo?</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Al borrar el conmplejo se borrarán todas sus reservas y mensajes también.<br>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <form id="formDel" action="{{url('/deleteComplejo/' . $complejo->id )}}" method="POST"
                          style="display:inline"> {{ method_field('DELETE') }} @csrf
                        <button type="submit" class="btn btn-danger" style="display:inline">Borrar complejo</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
