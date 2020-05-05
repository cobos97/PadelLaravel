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


<h1>Reservas del dia en {{$reservas[0]->pista->complejo->lugar}}, {{$reservas[0]->pista->complejo->direccion}}</h1>
<h2>Pista número {{$reservas[0]->pista->nPista}}</h2>

<table class="table table-bordered">
    <tr>
        <th>Hora</th>
        <th>Nombre</th>
        <th>Firma</th>
    </tr>
    @foreach($reservas as $reserva)
        <tr>
            <td>{{ date('H:i', $reserva->fecha) }}</td>
            <td>{{$reserva->user->name}} {{$reserva->user->apellidos}}</td>
            <td></td>
        </tr>
    @endforeach
</table>

<ul style="font-size: 30px">
    <li>Por favor, firmar en el recuadro que te corresponda.</li>
    <li>La persona que firma se hace responsable de los posibles
        desperfectos ocasionados en la pista.
    </li>
    <li>En caso de estar utilizando la pista sin haber firmado antes se penalizará al responsable de la reserva.</li>
</ul>

<p style="font-size: 50px">GRACIAS POR COLABORAR</p>


</body>
</html>