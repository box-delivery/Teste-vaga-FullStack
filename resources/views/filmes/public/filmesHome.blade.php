@extends('layouts.app')

@section('titulo')
{{$titulo}}
@stop

@section('css2')
<link rel="stylesheet" href="<?php echo asset('css/reset.css')?>" type="text/css">
<link rel="stylesheet" href="<?php echo asset('css/paginas.css')?>" type="text/css">
@stop

@section('content')
        <h2>Bem vindo a lista de filmes do site</h2>
        <input type="hidden" id="Me" value="{{$user->id}}">
        <ul class="filmes"></ul>
@stop

@section('rodape')
    <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    <script>var endereco="{{$url}}";</script>
    <script src=<?php echo asset('js/filmes.js')?>></script>
@stop