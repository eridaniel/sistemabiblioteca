<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>BIBLIOTECA</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js', 'resources/css/main.css'])
</head>
<body>
    <div id="app">
    <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
    <div class="container">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ms-auto">
        
                <li class="nav-item">
                    <a href="{{ route('logout') }}" class="btn btn-danger btn-sm-2 mb-2"><i class="fa-solid fa-right-from-bracket"></i> Cerrar sesión</a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </li>
            </ul>
        </div>
    </div>
</nav>


        <main class="py-2">
            @yield('content')
            <aside class="app-sidebar" style="width: 185px; background-color: #62152d;">
            <h2><a class="text-white" href="{{ route('welcome') }}">Sistema 
                Bibliotecario</a>
            </h2>
    <div class="app-sidebar__user">
        <img src="http://localhost/sistema-biblioteca/resources/views/LOGO.jpg" style="width: 150px;">
    </div>
    <ul class="app-menu-fixed">
        <li><a class="app-menu__item" href="{{ route('prestamos') }}">
            <i class="app-menu__icon fa-solid fa-handshake"></i>
            <span class="app-menu__label">Préstamos</span></a>
        </li>
        <li><a class="app-menu__item" href="{{ route('libros') }}">
            <i class="app-menu__icon fa fa-book"></i>
            <span class="app-menu__label">Libros</span></a>
        </li>
        <li class="nav-item dropdown">
            <a class="app-menu__item dropdown-toggle" href="#" id="clientesDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="app-menu__icon fa fa-user"></i>
            <span class="app-menu__label">Clientes</span></a>

                <ul class="dropdown-menu" aria-labelledby="clientesDropdown">
                    <li><a class="dropdown-item" href="{{ route('clientes') }}">Clientes Activos</a></li>
                    <li><a class="dropdown-item" href="{{ route('inactivos') }}">Clientes Inactivos</a></li>
                </ul>
            </li>
        </ul>
    </ul>
</aside>
    </main>
</div>
    
</body>
</html>