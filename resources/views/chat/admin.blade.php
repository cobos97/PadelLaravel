@extends('layouts.app')

@section('content')

    <a href="{{url('/chats')}}" class="enlace">Volver</a>



    <form class="form" action="{{url('/chat/' . $id)}}" method="post">
        @csrf
        <div class="row">
            <div class="col-9">
                <div class="form-group">
                    <label for="contenido" class="sr-only">Contenido</label>
                    <input type="text" class="form-control" id="contenido" name="contenido"
                           placeholder="Envie un mensaje"
                           required>
                </div>
            </div>
            <div class="col-3">
                <button type="submit" name="enviar" value="mensaje" class="btn btn-primary mb-2">Enviar</button>
                <button type="button" class="btn btn-danger mb-2" data-toggle="modal" data-target="#exampleModal">
                    Cerrar chat
                </button>
            </div>
        </div>

    </form>


    @if(count($chats)==0)
        <div class="alert alert-danger">No tienes mensajes de chat con el administrador</div>
    @else
        <div class="overflow-auto" style="height: 600px">

            @foreach($chats as $chat)

                @if ($chat->admin == 0)
                    <div class="row">
                        <div class="col-9">
                            <div class="mensaje ajeno">
                                <div class="d-flex w-100 justify-content-between">
                                    <h5 class="mb-1">{{$chat->user->name}}</h5>
                                </div>
                                <p class="mb-1">{{$chat->contenido}}</p>
                            </div>
                        </div>
                        <div class="col-3"></div>
                        <small class="fecha_ajeno">{{$chat->created_at}}</small>
                    </div>
                @else
                    <div class="row justify-content-end">
                        <div class="col-3"></div>
                        <div class="col-9">
                            <div class="mensaje propio">
                                <p class="mb-1">{{$chat->contenido}}</p>
                            </div>
                        </div>
                        <small class="fecha_propio">{{$chat->created_at}}</small>
                    </div>
                @endif

            @endforeach

        </div>
    @endif

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">¿Estás seguro que quieres cerrar este chat?</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Todos los mensajes intercambiados en este chat se perderán.<br>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <form id="formDel" action="{{url('/deletechat/' . $id )}}" method="POST"
                          style="display:inline"> {{ method_field('DELETE') }} @csrf
                        <button type="submit" class="btn btn-danger" style="display:inline">Cerrar chat</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection


