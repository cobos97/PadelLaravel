@extends('layouts.app')

@section('content')
    <a href="{{route('home')}}">Volver</a>
    <h1>Contacta con nosotros</h1>

    <form class="form" action="" method="post" enctype="multipart/form-data">
        @csrf
        <div class="form-group mb-2">
            <label for="correo">Correo</label>
            <input type="email" class="form-control" id="correo" name="correo" placeholder="Escriba su correo" required>
        </div>

        <div class="form-group mb-2">
            <label for="contenido">Contenido</label>
            <textarea name="contenido" id="contenido" class="form-control" required maxlength="1000"></textarea>
        </div>

        <button type="submit" name="enviar" value="enviar" class="btn btn-success mb-2">Enviar</button>
    </form>

@endsection
