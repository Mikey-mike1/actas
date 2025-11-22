<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>@yield('title') - Plataforma Actas</title>

    <!-- Materialize CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <!-- CSS personalizado -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    <style>
        body {
            background-color: #ffffff;
            font-family: Arial, sans-serif;
        }

        nav {
            background-color: #cc0000;
        }

        nav .brand-logo {
            color: #ffffff !important;
            font-weight: bold;
        }

        nav .sidenav-trigger i {
            color: #ffffff;
        }

        .sidenav {
            width: 250px;
        }

        .sidenav a {
            color: #cc0000 !important;
            font-weight: 500;
        }

        .sidenav .user-view .name,
        .sidenav .user-view .email {
            color: #cc0000;
        }

        .main-content {
            padding: 20px;
        }

        .text-brand {
            color: #cc0000;
            font-weight: bold;
        }
    </style>
</head>
<body>

    @auth
        <!-- Navbar superior -->
        <nav>
            <div class="nav-wrapper container">
                <a href="/dashboard" class="brand-logo"></a>
                <a href="#" data-target="slide-out" class="sidenav-trigger show-on-large">
                    <i class="material-icons">menu</i>
                </a>
            </div>
        </nav>

        <!-- Sidenav lateral -->
        <ul id="slide-out" class="sidenav">
            <li>
                <div class="user-view">
                    <div class="background" style="background-color: #ffffff;"></div>
                    <a href="#user"><img class="circle" src="https://upload.wikimedia.org/wikipedia/commons/9/99/Sample_User_Icon.png?20200919003010"></a>
                    <a href="#name"><span class="name" style="color:#cc0000">{{ auth()->user()->name ?? 'Usuario' }}</span></a>
                </div>
            </li>
            <li><a href="/dashboard"><i class="material-icons">dashboard</i>Dashboard</a></li>
            <li><a href="{{ route('actas.create') }}"><i class="material-icons">edit</i>Registrar Actas</a></li>
            <li><a href="{{ route('actas.listar') }}"><i class="material-icons">visibility</i>Ver Actas</a></li>
            <li><a href="{{ route('estadisticas.index') }}"><i class="material-icons">numbers</i>Estadísticas</a></li>
            <li><a href="{{ route('opciones.edit') }}"><i class="material-icons">settings</i>Opciones</a></li>
            @if(auth()->user()->rol === 'admin')
                <li><a href="{{ route('register') }}"><i class="material-icons">person_add</i>Registrar Usuario</a></li>
            @endif
            <li><div class="divider"></div></li>
            <li><a href="/logout"><i class="material-icons">exit_to_app</i>Cerrar sesión</a></li>
        </ul>
    @endauth

    <!-- Contenido principal -->
    <div class="container main-content">
        @yield('content')
    </div>

    <!-- Materialize JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var elems = document.querySelectorAll('.sidenav');
            M.Sidenav.init(elems, {});
        });
    </script>
</body>

</html>
