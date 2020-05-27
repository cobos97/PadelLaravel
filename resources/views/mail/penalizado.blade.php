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

Entra en padelsubbetica.duckdns.org para hacer tus reservas de padel y encontrar nuevas personas para
jugar.

<h1>Tu usuario ha recibido una penalización por parte del administrador</h1>

<p>No tendras acceso a las funciones principales de la web hasta la siguiente
    fecha: {{date('H:i d/m/Y', $user->penalizacion)}}</p>

<br>

<p>Para ponerte en contacto con el administradoir pulse <a
            href="padelsubbetica.duckdns.org/chatadmin">aquí</a> y vaya al chat con el administrador.</p>

<p style="font-size: 50px">GRACIAS POR UTILIZAR NUESTRA WEB</p>


</body>
</html>
