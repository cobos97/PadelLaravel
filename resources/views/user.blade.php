@extends('layouts.app')

@section('content')

    <h1>Hola {{$user->name}}, aquí puedes ver la información de tu perfil</h1>

    <strong>Nombre: </strong>{{$user->name}}
    <strong>Apellidos: </strong>{{$user->apellidos}}
    <strong>Edad: </strong>{{$user->edad}}

    <!-- Button trigger modal -->
    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModal">
        Editar información
    </button>

    <h2>Tus reservas</h2>

    @if(count($reservas)==0)
        <div class="alert alert-danger">No tienes reservas futuras guardadas en el sistema</div>

    @else


        <table class="table table-striped">
            <thead>
            <tr>
                <th scope="col">Usuario</th>
                <th scope="col">Pista</th>
                <th scope="col">Fecha</th>
                <th scope="col"></th>
            </tr>
            </thead>
            <tbody>

            @foreach($reservas as $reserva)
                <tr>
                    <th scope="row">{{$reserva->user->name}}</th>
                    <td>{{$reserva->pista->lugar}}, {{$reserva->pista->direccion}}-{{$reserva->pista->nPista}}</td>
                    <td>{{date('H:i d/m/Y', $reserva->fecha)}}</td>
                    <td>
                        {{--
                        <form action="{{url('/deleteReservaUser/' . $reserva->id )}}" method="POST"
                              style="display:inline"> {{ method_field('DELETE') }} @csrf
                            <button type="submit" class="btn btn-danger" style="display:inline">Cancelar</button>
                        </form>
                        --}}
                        <button id="cancelar" type="button" class="btn btn-danger" data-toggle="modal"
                                data-target="#delexampleModal" onclick="event.preventDefault();
                                document.getElementById('formDel').setAttribute('action', '{{url('/deleteReservaUser/' . $reserva->id )}}');">
                            Anular
                        </button>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

    @endif

    <!-- Button trigger modal -->


    <!-- Modal -->
    <div class="modal fade" id="delexampleModal" tabindex="-1" role="dialog" aria-labelledby="delexampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">¿Estás seguro que quieres anular esta reserva?</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <form id="formDel" action="{{url('/deleteReservaUser/' . $reserva->id )}}" method="POST"
                          style="display:inline"> {{ method_field('DELETE') }} @csrf
                        <button type="submit" class="btn btn-danger" style="display:inline">Anular reserva</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Información</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">


                    <form id="editarForm" class="form" action="" method="post" enctype="multipart/form-data">
                        @csrf
                        {{method_field('PUT')}}
                        <div class="form-group mb-2">
                            <label for="nombre">Nombre</label>
                            <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre"
                                   value="{{ $user->name }}" required>
                        </div>
                        <div class="form-group mb-2">
                            <label for="apellidos">Apellidos</label>
                            <input type="text" class="form-control" id="apellidos" name="apellidos"
                                   placeholder="Apellidos"
                                   value="{{ $user->apellidos }}" required>
                        </div>
                        <div class="form-group mb-2">
                            <label for="edad">Edad</label>
                            <input type="number" class="form-control" id="edad" name="edad" value="{{ $user->edad }}"
                                   required>
                        </div>

                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        <button type="submit" name="editar" value="usuario" class="btn btn-success">Guardar cambios
                        </button>

                    </form>

                </div>

            </div>
        </div>
    </div>

@endsection

@section('scripts')

    <script>

        $('#cancelar').click(function () {
            console.log('funciona');
        })

    </script>

@endsection