<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Wallapush') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet">
    @yield('links')
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU"
        crossorigin="anonymous">
</head>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light navbar-laravel" style="margin-bottom: 20px;">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Wallapush') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                                Anuncios
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                @if(Auth::check())
                                <a class="dropdown-item" href="{{ route('addAnuncio') }}">Añadir</a>
                                @endif
                                <a class="dropdown-item" href="{{ route('listAnuncios') }}">Listado</a>
                                @if(Auth::check())
                                @if (Auth::user()->role == 'admin')
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="{{ route('vendidos') }}">Productos vendidos</a>
                                <a class="dropdown-item" href="{{ route('categorias') }}">Añadir categoría</a>
                                @endif
                                @endif

                            </div>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                                Categorias
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                @foreach (\App\categoria::orderBy('nombre')->get() as $categoria)
                            <a class="dropdown-item categorias-list" href="{{ route('listPorCategoria', $categoria->id )}}">{{ $categoria->nombre }}</a>
                                @endforeach
                                {{-- @if(Auth::check())
                                <a class="dropdown-item" href="{{ route('addAnuncio') }}">Añadir</a>
                                @endif
                                <a class="dropdown-item" href="{{ route('listAnuncios') }}">Listado</a>
                                @if(Auth::check())
                                @if (Auth::user()->role == 'admin')
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="{{ route('vendidos') }}">Productos vendidos</a>
                                <a class="dropdown-item" href="{{ route('categorias') }}">Añadir categoría</a>
                                @endif
                                @endif --}}

                            </div>
                        </li>
                        @if(Auth::check())
                        @if(auth()->user()->role == 'admin')
                        <li><a class="nav-item nav-link" href="{{ route('users.index') }}">{{ __('Usuarios') }}</a></li>
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
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                @if(auth()->user()->role != 'admin')
                                    <a class="nav-link" href="{{ route('profile') }}">Perfil</a>
                                    <a class="nav-link" href="{{ route('valorarcompra') }}">Valorar compras</a>
                                    <a class="nav-link" href="{{ route('compras') }}">Compras realizadas</a>
                                    <a class="nav-link" href="{{ route('ventas') }}">Ventas realizadas</a>
                                @endif
                                <hr>
                                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        @yield('content')
        <!-- <footer class="text-muted text-center text-small">
            <p class="mb-1">&copy; 2018-2019 Wallapush</p>
            <ul class="list-inline">
                <li class="list-inline-item"><a href="#">Privacy</a></li>
                <li class="list-inline-item"><a href="#">Terms</a></li>
                <li class="list-inline-item"><a href="#">Support</a></li>
            </ul>
        </footer> -->
    </div>
</body>

</html>
