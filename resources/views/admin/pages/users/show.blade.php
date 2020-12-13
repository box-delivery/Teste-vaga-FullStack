@extends('admin.layouts.app')

@section('title', 'Admin User - Github')

@section('content')

<h1 class="text-center">Vizualizar</h1>
<hr>
<div class="col-8 m-auto">
    <div class="text-center mt-3 mb-4">
        <a href="/users">
            <button class="btn btn-info">Voltar</button>
        </a>
    </div>
    <div class="card" style="width: 18rem;">
        <img class="card-img-top" src="../img/user.png" alt="User">
        <div class="card-body">
            <h5 class="card-title text-center">
            @php
            $user=$tag->find($tag->id)->relUser;
            @endphp
                Pesquisa realizada por: <b>{{ $user->name }}</b>
            </h5>
            <p class="card-text">Email: <b>{{$user->email}}</b></p>
            <p class="card-text">Cadastrado: <b>{{$user->created_at}}</b></p>
        </div>
        <ul class="list-group list-group-flush">
            <li class="list-group-item">Termo: <b>{{$tag->nome}}</b></li>
            <li class="list-group-item">Language: <b>{{$tag->language}}</b> </li>            
        </ul>
        <div class="card-body">
            <a href="{{$tag->image}}" class="card-link" target="_blank">
            <img src="{{$tag->image}}" width="200" height="150">
            </a>
        </div>
    </div>    
</div>
@endsection