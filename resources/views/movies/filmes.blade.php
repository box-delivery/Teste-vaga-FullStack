@extends('movies.template.pagina1')

@section('conteudo')
        <div id="filmesConteudo">
            <h2>Bem vindo a lista de filmes do site </h2>
            <ul class="filmes"></ul>
        </div>
@stop  

@section('js')
    <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    <script>
    var endereco="{{$url}}";
    var ApiFilmes="{{$ApiFilmes}}";
    var Favoritar="{{$favoritar}}";
    </script>
    <script src=<?php echo asset('js/filmes.js')?>></script>
@stop