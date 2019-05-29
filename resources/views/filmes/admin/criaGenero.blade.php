@extends('layouts.app')


@section('css2') 
@stop


@section('content')
    <div id='criaGenero'>
       <form action="{{url('filmes/generos/criar')}}" method='post'  enctype="multipart/form-data">
            {{ csrf_field() }}
            <label for="idGenero">Genero</label><input type="text" id="idGenero" name="genero">
            <input type="submit" value="cadastrar">
       </form>
            <ul> 
                @foreach($all as $a)
                    <li>{{$a->genero}}</li>
                @endforeach
            </ul>
    </div>
@stop