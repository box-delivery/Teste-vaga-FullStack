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
                            <form method="POST" action="{{ route('login') }}">
                                @csrf
                                <div class="form-group row">
                                    <div class="input-field">
                                        <input id="email" name="email" type="email" class="validate" required
                                               autocomplete="email" autofocus>
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
                                        <input id="loginPassword" type="password" class="validate" name="password"
                                               required autocomplete="current-password">
                                        <label for="loginPassword">Password</label>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="input-field">
                                        <button class="btn waves-effect waves-ligh red darken-2" type="submit"
                                                name="action">Submit
                                            <i class="material-icons right">send</i>
                                        </button>
                                    </div>
                                </div>

                                <p>Need an account? <a href="{{ route("register") }}" class="red-text">Register here</a></p>
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

