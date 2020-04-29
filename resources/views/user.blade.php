@extends('layouts.app')

@section('content')

    <h1>Hola {{$user->name}}, aquí puedes ver la información de tu perfil</h1>

    <strong>Nombre: </strong>{{$user->name}}
    <strong>Apellidos: </strong>{{$user->apellidos}}
    <strong>Edad: </strong>{{$user->edad}}

    <!-- Button trigger modal -->
    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModal">
        Editar información <i class="fas fa-user-edit"></i>
    </button>

    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#passexampleModal">
        Cambiar contraseña <i class="fas fa-key"></i>
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
                    <td>{{$reserva->pista->complejo->lugar}}, {{$reserva->pista->complejo->direccion}}
                        -{{$reserva->pista->nPista}}</td>
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
                            Anular <i class="fas fa-window-close"></i>
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
                    @if(count($reservas)!=0)
                        <form id="formDel" action="{{url('/deleteReservaUser/' . $reserva->id )}}" method="POST"
                              style="display:inline"> {{ method_field('DELETE') }} @csrf
                            <button type="submit" class="btn btn-danger" style="display:inline">Anular reserva</button>
                        </form>
                    @endif
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

    <!-- Modal -->
    <div class="modal fade" id="passexampleModal" tabindex="-1" role="dialog" aria-labelledby="passexampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Cambiar contraseña</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">


                    <form id="passForm" class="form" action="" method="post">
                        @csrf
                        {{method_field('PUT')}}
                        <div class="form-group mb-2">
                            <label for="nombre">Contraseña</label>
                            <input type="password" class="form-control" id="pass" name="pass" placeholder="Contraseña"
                                   required minlength="10">
                        </div>
                        <div class="form-group mb-2">
                            <label for="apellidos">Repetir contraseña</label>
                            <input type="password" class="form-control" id="reppass" name="reppass"
                                   placeholder="Repetir contraseña" onkeyup="comprobar()">
                        </div>

                        <div class="alert alert-danger" id="error">Las contraseñas deben de coincidir para poder
                            cambiarla
                        </div>

                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        <button id="dis" type="submit" name="editar" value="usuario" class="btn btn-success" disabled>
                            Guardar nueva contraseña
                        </button>

                    </form>

                </div>

            </div>
        </div>
    </div>

@endsection

@section('scripts')

    <script>

        function comprobar() {
            if (document.getElementById('pass').value == document.getElementById('reppass').value) {
                document.getElementById('error').setAttribute('hidden', 'hidden');
                document.getElementById("dis").removeAttribute('disabled');
            } else {
                document.getElementById('dis').setAttribute('disabled', 'disabled');
                document.getElementById("error").removeAttribute('hidden');
            }
        }

    </script>

@endsection