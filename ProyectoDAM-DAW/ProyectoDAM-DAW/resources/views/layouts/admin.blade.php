<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <!--Metas-->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="title" content="Panel de administración">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config(/*'app.name',*/ 'Panel de administración') }}</title>

    <!-- Styles -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <link href="{{ asset('css/admin.css') }}" rel="stylesheet">
</head>

<body>

<nav>
    <div class="nav-wrapper">
        <!--Logo-->
        <a href="{{ route('acceder') }}" class="brand-logo" title="Inicio">
            {{ Html::image('img/logo.jpg', 'Logo Street Find') }}
        </a>

        <!--Botón menú móviles-->
        <a href="#" data-target="mobile-demo" class="sidenav-trigger"><i class="material-icons">menu</i></a>

    @if( Auth::check() )
        <!--Menú de navegación-->
            <ul id="nav-mobile" class="right hide-on-med-and-down">
                <li>
                    <a href="{{ route('admin') }}" title="Inicio">Inicio</a>
                </li>
                @if( Auth::user()->estadisticas )
                    <li>
                        <a href="{{ url('admin/estadisticas/index/{id}') }}" title="Estadisticas">Mis estadísticas</a>
                    </li>
                @endif
                @if( Auth::user()->jugadores )
                    <li>
                        <a href="{{ url('admin/jugadores') }}" title="Jugadores">Jugadores</a>
                    </li>
                @endif
                <li>
                    <form method="POST" action="{{ route('salir') }}">
                        @csrf
                        <a onclick="$(this).closest('form').submit()" title="Salir"  class="grey-text">
                            Salir
                        </a>
                    </form>
                </li>
            </ul>
        @endif

    </div>
</nav>

@if( Auth::check() )
    <!--Menú de navegación móvil-->
    <ul class="sidenav" id="mobile-demo">
        <li>
            <a href="{{ route('admin') }}" title="Inicio">Inicio</a>
        </li>

        @if( Auth::user()->jugadores)
            <li>
                <a href="{{ url('admin/jugadores') }}" title="Jugadores">jugadores</a>
            </li>

        @elseif(Auth::user()->estadisticas)
            <li>
                <a href="{{ url('admin/estadisticas/index/{id}') }}" title="Estadisticas">Mis estadísticas</a>
            </li>
        @endif

        <li>
            <form method="POST" action="{{ route('salir') }}">
                @csrf
                <a onclick="$(this).closest('form').submit()" title="Salir"  class="grey-text">
                    Salir
                </a>
            </form>
        </li>
    </ul>
@endif

<!-- Mensajes  -->
@include('admin.partials.mensajes')

<main>

    <header>


        @if( Auth::check() )
<!--echo 1-->
            <h1>

                Bienvenido a Street Find, <strong>{{Auth::user()->jugador}}</strong>
            </h1>

        @else

            <h2>Bienvenido, introduce tus datos.</h2>

        @endif
    </header>

    <section class="container-fluid">

        <!--Content-->
        @yield('content')


    </section>
</main>

<!--Footer-->
<footer class="center-align">

    © <?php echo date("Y") ?>
    <a href="{{route('acerca')}}" target="_blank" title="EQUIPO DAM-DAW">
        EQUIPO DAM-DAW
    </a>
</footer>

</body>

<!--Scripts-->
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
<script src="{{ asset('js/admin.js') }}" defer></script>

</html>
