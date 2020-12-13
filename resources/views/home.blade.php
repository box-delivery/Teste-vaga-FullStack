@extends('layouts.app')

@section('content')
<style>
    .container img {
        max-width:200px;
        max-height:150px;
        width: auto;
        height: auto;
    }
    .card-titles {
        width: 13rem; 
        float: left; 
        margin-right: 1%
    }
</style>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <div class="card card-titles">
                        <img class="card-img-top" src="img/cinema.jpg" alt="cinema">
                        <div class="card-body">
                            <h5 class="card-title">Buscar Filmes Favoritos</h5>
                            <p class="card-text">Modulo de Busca utilizando api TMDB.</p>
                            <a href="/search" class="btn btn-primary">Entrar</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection