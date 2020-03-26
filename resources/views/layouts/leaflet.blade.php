<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('APP_NAME', 'PadelSubbetica') }}</title>

    {{--Script de leaflet--}}

    <script src="https://code.jquery.com/jquery-3.4.1.js"
            integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU="
            crossorigin="anonymous"></script>

    <script src="https://unpkg.com/leaflet@1.6.0/dist/leaflet.js"
            integrity="sha512-gZwIG9x3wUXg2hdXF6+rVkLF/0Vi9U8D2Ntg4Ga5I5BZpVkVxlJWbSQtXPSiUTtC0TjtGOmxa1AJPuV0CPthew=="
            crossorigin=""></script>

    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.6.0/dist/leaflet.css"
          integrity="sha512-xwE/Az9zrjBIphAcBb3F6JVqxf46+CDLwfLMHloNu6KEQCAWi6HcDUbeOfBIptF7tcCzusKFjFw2yuvEpDL9wQ=="
          crossorigin=""/>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

</head>

<style>
    #mapid {
        height: 400px;
    }
</style>

<body>

<div id="app">
    <nav id="menu" class="navbar navbar-expand-md navbar-dark shadow-sm fixed-top">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">
                {{ config('APP_NAME', 'PadelSubbetica') }}
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Left Side Of Navbar -->
                <ul class="navbar-nav mr-auto">
                    {{--
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('mensajes')}}">Mensajes</a>
                    </li>
                    --}}
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('pistas')}}">Pistas</a>
                    </li>
                    @if(Auth()->user())
                        @if(Auth()->user()->rol == 'admin')
                            <li class="nav-item">
                                <a class="nav-link" href="{{route('admin')}}">Zona de administracion</a>
                            </li>
                        @endif
                    @endif

                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ml-auto">
                    <!-- Authentication Links -->
                    @guest
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                        @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                            </li>
                        @endif
                    @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                      style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>

    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <a href="{{route('pistas')}}"><img class="imgcar" style="width: 100%"
                                                   src="{{asset('imagenes/bg_padel.jpg')}}" alt="..."></a>
                <div class="carousel-caption">
                    <h5>Pistas</h5>
                    <p class="d-none d-md-block">Visita nuestro listado de pistas</p>
                </div>
            </div>
            <div class="carousel-item">
                <img class="imgcar" style="width: 100%" src="{{asset('imagenes/bg_padel.jpg')}}" alt="...">
                <div class="carousel-caption">
                    <h5>No se</h5>
                    <p class=" d-none d-md-block">...</p>
                </div>
            </div>
            <div class="carousel-item">
                <img class="imgcar" style="width: 100%" src="{{asset('imagenes/bg_padel.jpg')}}" alt="...">
                <div class="carousel-caption">
                    <h5>Contacto</h5>
                    <p class=" d-none d-md-block">...</p>
                </div>
            </div>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
    <main class="py-4">
        <div class="container">
            @include('flash::message')

            @yield('content')

            <h2 style="margin-top: 50px">Localización</h2>

            <div id="mapid"></div>

        </div>
    </main>
</div>
<div class="footer text-center">
    <p>&copy; <?php print date("Y"); ?> <a href="https://iesmarquesdecomares.org/" class="enlace"> IES Marqués de
            Comares.</a></p>
</div>
</body>

<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
        crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
        integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6"
        crossorigin="anonymous"></script>

<script>

    if (isMobile()) {
        $('.imgcar1').attr('src', "{{asset('imagenes/chica.jpg')}}");
        $('.imgcar2').attr('src', "{{asset('imagenes/chica.jpg')}}");
        $('.imgcar3').attr('src', "{{asset('imagenes/bg_pelota.jpg')}}");
    }

    function isMobile() {
        return (
            (navigator.userAgent.match(/Android/i)) ||
            (navigator.userAgent.match(/webOS/i)) ||
            (navigator.userAgent.match(/iPhone/i)) ||
            (navigator.userAgent.match(/iPod/i)) ||
            (navigator.userAgent.match(/iPad/i)) ||
            (navigator.userAgent.match(/BlackBerry/i))
        );
    }


    $(window).scroll(function () {
        if ($('#menu').offset().top > 120) {
            $('#menu').addClass('nav-scroll');
        } else {
            $('#menu').removeClass('nav-scroll');
        }
    })
</script>

@yield('coor')


</html>