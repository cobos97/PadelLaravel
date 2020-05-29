<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
          integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

</head>
<body>


<img style="width: 100px" src="{{asset('imagenes/padel.png')}}">
<strong style="font-size: 40px">PADELSUBBETICA</strong>
<br>

Entra en www.padelsubbetica.duckdns.org para hacer tus reservas de padel y encontrar nuevas personas para
jugar.

<table class="table table-bordered">
    <tr>
        <th>Nombre completo</th>
        <th>Fecha</th>
        <th>Pista</th>
    </tr>
    @foreach($reservas as $reserva)
        <tr>
            <td>{{$reserva->user->name}} {{$reserva->user->apellidos}}</td>
            <td>{{ date('H:i d/m/Y', $reserva->fecha) }}</td>
            <td>{{$reserva->pista->complejo->lugar}}, {{$reserva->pista->complejo->direccion}} - Pista
                Nº{{$reserva->pista->nPista}}</td>
        </tr>
    @endforeach
</table>

</body>
</html>