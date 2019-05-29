@extends('movies.template.pagina1')

@section('conteudo')
   <div id='loginScreen'>
        <form action="">
            <h1>Acesse sua conta</h1>
            <input required='required' id="email" type="text" name="email" placeholder="digite seu email">
            <input required='required' id="password"  type="text" name="password" placeholder="digite sua senha">
            <button class="btn">login</button>
        </form>
        <small><a href='{{ url('/cadastro')}}'>Registre-se agora mesmo</a></small>
    </div>
@stop


@section('js')
<script>var  EndLogin ="{{$ApiLogin}}";</script>
<script src=<?php echo asset('js/login.js')?>></script>
@stop