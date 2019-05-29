@extends('movies.template.pagina1')

@section('conteudo')
    <div id="registro">
            <form action="">
                <p><input required='required' id="name" type="text" name="name" placeholder="digite seu nome"></p>
                <p><input required='required' id="email" type="email" name="email" placeholder="digite seu email"></p>
                <p><input required='required' id="password" type="text" name="password" placeholder="digite a senha com pelo menos, 8 digitos"></p>
                <p><input required='required' id="password_confirmation" type="text" name="password_confirmation" placeholder="confirme o password"></p>
                <button>cadastrar</button>
            </form>
            <small>
                <a href="{{ url('/')}}">fazer login</a>
            </small>
    </div>
@stop

@section('js')
<script>
    var urlCAd="{{$ApiCad}}";
    var Redirect="{{$redirect}}";
</script>
<script src=<?php echo asset('js/cadastro.js')?>></script>
@stop