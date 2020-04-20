@extends('layouts.app')

@section('content')
    <a href="{{route('admin')}}" class="enlace">Volver</a>
    <h1>Control de usuarios</h1>

    <table class="table table-striped">
        <thead>
        <tr>
            <th scope="col">Nombre</th>
            <th scope="col">Correo</th>
            <th scope="col">Apellidos</th>
            <th scope="col">Edad</th>
            <th scope="col">Rol</th>
            <th scope="col">Verificado</th>
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
                <td>{{$usuario->edad}}</td>
                <td>{{$usuario->rol}}</td>
                <td>{{$usuario->email_verified_at}}</td>
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
                        {{--
                        <form action="{{url('/deleteUsuario/' . $usuario->id )}}" method="POST"
                              style="display:inline"> {{ method_field('DELETE') }} @csrf
                            <button type="submit" class="btn btn-danger" style="display:inline">Borrar</button>
                        </form>
                        --}}
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
            }else{
                document.getElementById('dis').setAttribute('disabled', 'disabled');
                document.getElementById("error").removeAttribute('hidden');
            }
        }

    </script>

@endsection