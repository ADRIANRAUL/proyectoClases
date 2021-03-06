<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Lets Code') }} - admin</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Lets Code') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }} - {{ Auth::user()->isAdmin()  }} <span class="caret"></span>
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                                    document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <main class="container-fluid">
            <div class="row p-2">
                <div class="col col-md-2">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title">Menu</div>
                            <div class="list-group">
                                @if( Auth::user()->isAdmin() )
                                    <a href="{{ route('home') }}" @if( Route::getCurrentRoute()->getName() == 'home' ) class="list-group-item active" @else class="list-group-item" @endif > Inicio </a>
                                    <a href="{{ route('company.show') }}" @if( Route::getCurrentRoute()->getName() == 'company.show' ) class="list-group-item active" @else class="list-group-item" @endif > Empresa </a>
                                    <a href="{{ route('role.layout') }}" @if( Route::getCurrentRoute()->getName() == 'role.layout' ) class="list-group-item active" @else class="list-group-item" @endif > Roles </a>
                                    <a href="{{ route('users.layout') }}" @if( Route::getCurrentRoute()->getName() == 'users.layout' ) class="list-group-item active" @else class="list-group-item" @endif > Usuarios </a>
                                    <a href="{{ route('posts.layout') }}" @if( Route::getCurrentRoute()->getName() == 'posts.layout' ) class="list-group-item active" @else class="list-group-item" @endif > Publicaciones </a>
                                @else
                                    <a href="{{ route('posts.layout') }}" @if( Route::getCurrentRoute()->getName() == 'posts.layout' ) class="list-group-item active" @else class="list-group-item" @endif > Publicaciones </a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col col-md-10">
                    @yield('content')
                </div>
            </div>
        </main>

    </div>
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="//cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    @yield('scripts')
</body>
</html>
