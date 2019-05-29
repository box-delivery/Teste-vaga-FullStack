@extends('movies.template.pagina1')


@section('conteudo')
 <main id='favoritos'>
     <h1>filmes favoritos</h1>
     <ul class='favoritosLista'></ul>
 </main>
@stop


@section('js')
    <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    <script>
    var endereco="{{$url}}";
    var favoritos="{{$favoritos}}";
    </script>
    <script src=<?php echo asset('js/filmesFavoritos.js')?>></script>
@stop