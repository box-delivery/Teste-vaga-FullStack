@extends('layouts.app')

@section('css2')
<link rel="stylesheet" href="<?php echo asset('css/reset.css')?>" type="text/css">
<link rel="stylesheet" href="<?php echo asset('css/paginasFavoritas.css')?>" type="text/css">
@stop


@section('content')
 <main id='favoritos'>
     <h1>filmes favoritos</h1>
     <ul class='favoritosLista'></ul>
 </main>
@stop


@section('rodape')
    <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    <script>var endereco="{{$url}}";</script>
    <script src=<?php echo asset('js/filmesFavoritos.js')?>></script>
@stop