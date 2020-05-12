@extends('layouts.app')

@section('content')

    <a href="{{url('/home')}}" class="enlace">Volver</a>

    <form class="form" action="" method="post">
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
            </div>
        </div>

    </form>


    @if(count($chats)==0)
        <div class="alert alert-danger">No tienes mensajes de chat con el administrador</div>
    @else
        <div class="overflow-auto" style="height: 600px">

            @foreach($chats as $chat)

                @if ($chat->admin == 1)
                    <div class="row">
                        <div class="col-9">
                            <div class="mensaje ajeno">
                                <div class="d-flex w-100 justify-content-between">
                                    <h5 class="mb-1">Administrador</h5>
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



@endsection