@extends('layouts.app')

@section('content')
    <a href="{{route('admin')}}" class="enlace">Volver</a>
    <h1>Control de usuarios</h1>

    <h2>Filtra los usuarios</h2>
    <form class="form" action="" method="post" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="nombre" class="sr-only">Correo</label>
            <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Correo electrónico">
        </div>
        <button type="submit" name="filtrar" value="usuario" class="btn btn-success mb-2">Filtrar</button>
    </form>

    <table class="table table-striped">
        <thead>
        <tr>
            <th scope="col">Correo</th>
            <th scope="col">Nombre</th>
            <th scope="col">Apellidos</th>
            <th scope="col">Edad</th>
            <th scope="col">Rol</th>
            <th scope="col">Verificado</th>
            <th scope="col">Penalización</th>
            <th scope="col"></th>
            <th scope="col"></th>
            <th scope="col"></th>
        </tr>
        </thead>
        <tbody>
        @foreach($usuarios as $usuario)
            <tr>
                <th scope="row">{{$usuario->email}}</th>
                <td>{{$usuario->name}}</td>
                <td>{{$usuario->apellidos}}</td>
                <td>{{ intdiv(time()-$usuario->fecha_nac, 31536000) }}</td>
                <td>{{$usuario->rol}}</td>
                <td>{{$usuario->email_verified_at}}</td>
                <td>
                    @if($usuario->rol != 'admin')
                        @if($usuario->penalizacion > time())
                            <p>Hasta: {{date('H:i d/m/Y', $usuario->penalizacion)}}</p>
                            <form action="{{url('/deletepenalizacion/' . $usuario->id )}}" method="POST"
                                  style="display:inline"> {{ method_field('PUT') }} @csrf
                                <button type="submit" class="btn btn-danger" style="color:white">Anular</button>
                            </form>
                        @else
                            <button id="panalizar" type="button" class="btn btn-warning" data-toggle="modal"
                                    data-target="#pelexampleModal" onclick="event.preventDefault();
                                    document.getElementById('formPel').setAttribute('action', '{{url('/penalizarusuario/' . $usuario->id )}}');">
                                Penalizar
                            </button>
                        @endif

                    @endif
                </td>
                <td>
                    <a href="{{ url('/editarUsuario/' . $usuario->id ) }}" class="btn btn-success">Editar</a>
                </td>
                <td>
                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#passexampleModal"
                            onclick="event.preventDefault();
                                    document.getElementById('passForm').setAttribute('action', '{{url('/user/' . $usuario->id )}}');">
                        Cambiar contraseña
                    </button>
                </td>
                <td>
                    @if($usuario->rol != 'admin')
                        <button id="cancelar" type="button" class="btn btn-danger" data-toggle="modal"
                                data-target="#delexampleModal" onclick="event.preventDefault();
                                document.getElementById('formDel').setAttribute('action', '{{url('/deleteUsuario/' . $usuario->id )}}');">
                            Borrar
                        </button>
                    @endif
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <!-- Modal -->
    <div class="modal fade" id="pelexampleModal" tabindex="-1" role="dialog" aria-labelledby="pelexampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Penalizar usuario</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Al penalizar al usuario no tendra acceso a la sección de complejos.

                    <form class="form" id="formPel" action="{{url('/penalizarusuario/' . $usuario->id )}}" method="POST"
                          style="display:inline"> {{ method_field('PUT') }} @csrf
                        <label class="sr-only">Tiempo de penalización en días</label>
                        <input class="form-control mb-2" type="number" name="dias"
                               placeholder="Introduce un número de días a penalizar">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-danger" style="display:inline">Penalizar usuario</button>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <!-- Modal -->
    <div class="modal fade" id="delexampleModal" tabindex="-1" role="dialog" aria-labelledby="delexampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">¿Estás seguro que quieres borrar este usuario?</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Al borrar el usuario se borrarán todos sus mensajes y reservas también.
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <form id="formDel" action="{{url('/deleteUsuario/' . $usuario->id )}}" method="POST"
                          style="display:inline"> {{ method_field('DELETE') }} @csrf
                        <button type="submit" class="btn btn-danger" style="display:inline">Borrar usuario</button>
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