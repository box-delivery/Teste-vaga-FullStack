<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>MovieFlix</title>
    <meta name="token" content="{{ csrf_token() }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css" rel="stylesheet" >
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset("assets/css/style.min.css") }}">
    <link rel="icon" type="image/png" href="{{ asset("assets/img/icon.png") }}" />
</head>
<body>
<div class="preloader"></div>
<div class="navbar-fixed">
    <nav>
        <div class="nav-wrapper grey darken-3">
            <a href="{{ route("index") }}" class="brand-logo">
                <img src="{{asset('assets/img/logo.png')}}" alt="">
            </a>
            <a href="#" data-target="menu-mobile" class="sidenav-trigger">
                <i class="material-icons">menu</i>
            </a>
            <ul class="right hide-on-med-and-down">
                @guest()
                    <li><a href="{{ route("login") }}"><i class="material-icons red-text">login</i></a></li>
                @else
                    <li><a href="{{ route("index") }}"><i class="material-icons">home</i> Home</a></li>
                    <li><a href="{{ route("movies") }}"><i class="material-icons">local_movies</i> Movies</a></li>
                    <li><a href="{{ route("favorites") }}"><i class="material-icons">favorite_border</i> Favorites</a></li>
                    <li><a onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="material-icons  red-text">logout</i></a></li>
                @endguest
            </ul>
        </div>
    </nav>
</div>
<ul class="sidenav" id="menu-mobile">
    @guest()
        <li><a href="{{ route("login") }}"><i class="material-icons red-text">login</i> Login</a></li>
    @else
        <li><a href="{{ route("index") }}"><i class="material-icons">home</i> Home</a></li>
        <li><a href="{{ route("movies") }}"><i class="material-icons">local_movies</i> Movies</a></li>
        <li><a href="{{ route("favorites") }}"><i class="material-icons">favorite_border</i> Favorites</a></li>
        <li><a onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="material-icons red-text">logout</i> Logout</a></li>
    @endguest
</ul>

@yield("content")

@auth()
    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>
@endauth

<footer class="grey darken-4">
    <p>&copy; MovieFlix &mdash; {{ date('Y') }}</p>
    <a href="https://leandjoao.com.br" target="_blank">@leandjoao</a>
</footer>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
<script src="{{ asset("assets/js/scripts.js") }}"></script>
</body>
</html>
