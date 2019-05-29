@extends('layouts.app')


@section('css2') 
@stop


@section('content')
    <div id='login'>
        <form action="">

               <input type="text" name='email' placeholder='digite seu email'>
               <input type="text" name='password'  placeholder='digite sua senha'>
               <button class="btn">enviar</button>
                <div id="mensagem"></div>
        </form>
    </div>
@stop

@section('rodape')
    <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    <script src=<?php echo asset('js/login.js')?>></script>
@stop