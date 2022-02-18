<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <!--Metas-->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="title" content="lkjh">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Home</title>

    <!-- Styles -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

<body>

<nav>
    <div class="nav-wrapper">
        <!--Logo-->
        <a href="{{ route('home') }}" class="brand-logo" title="Inicio">
            {{ Html::image('img/logo.jpg', 'Logo Street Find') }}
        </a>

        <!--Botón menú móviles-->
        <a href="#" data-target="mobile-demo" class="sidenav-trigger"><i class="material-icons">menu</i></a>

        <!--Menú de navegación-->
        <ul id="nav-mobile" class="right hide-on-med-and-down">
            <li>
                <a href="{{ route('home') }}" title="Inicio">Inicio</a>
            </li>

            <li>
                <a href="{{ route('acerca') }}" title="Acerca de">Acerca de</a>
            </li>

        </ul>

    </div>
</nav>

<!--Menú de navegación móvil-->
<ul class="sidenav" id="mobile-demo">
    <li>
        <a href="{{ route('home') }}" title="Inicio">Inicio</a>
    </li>

    <li>
        <a href="{{ route('acerca') }}" title="Acerca de">Acerca de</a>
    </li>

</ul>

<main>

    <header>
        <h1>Street Find</h1>
    </header>

    <section class="container-fluid">

        <!--Content-->
    @yield('content')

    <!--Footer-->
    </section>
</main>

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
<script src="{{ asset('js/app.js') }}" defer></script>

</html>
