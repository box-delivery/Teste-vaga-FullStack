<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>MovieFlix :: Login</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset("assets/css/style.min.css") }}">
    <link rel="icon" type="image/png" href="{{ asset("assets/img/icon.png") }}" />
</head>
<body class="login">

<div class="container">
    <div class="row">
        <div class="card z-depth-5">
            <div class="card-content center-align grey darken-4">
                <a href="{{ route("index") }}">
                    <img src="{{ asset('assets/img/logo.png') }}" alt="">
                </a>
            </div>
            <div class="card-content grey lighten-5">
                <div id="login">
                    <div class="login-form">
                        <div class="row">
                            <form method="POST" action="{{ route('register') }}">
                                @csrf

                                <div class="form-group row">
                                    <div class="input-field">
                                        <input id="name" type="text" class="validate" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                                        <label for="name">Name</label>
                                        @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="input-field">
                                        <input id="email" type="email" class="validate" name="email" value="{{ old('email') }}" required autocomplete="email">
                                        <label for="email">E-mail</label>
                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="input-field">
                                        <input id="password" type="password" class="validate" name="password" required autocomplete="new-password">
                                        <label for="password">Password</label>

                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="input-field">
                                        <input id="password-confirm" type="password" class="validate" name="password_confirmation" required autocomplete="new-password">
                                        <label for="password-confirm">Confirm Password</label>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="input-field">
                                        <button class="btn waves-effect waves-light red darken-2" type="submit"
                                                name="action">Submit
                                            <i class="material-icons right">send</i>
                                        </button>
                                    </div>
                                </div>
                                <p>Already a member? <a href="{{ route("login") }}" class="red-text">Login here</a></p>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
<script src="{{ asset("assets/js/scripts.js") }}"></script>
</body>
</html>
