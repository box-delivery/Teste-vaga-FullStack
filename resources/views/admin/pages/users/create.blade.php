@extends('admin.layouts.app')

@section('title', 'Admin User - Github')

@section('content')
<h1 class="text-center">
    @if(isset($tags)) Editar @else Cadastrar @endif
</h1>
<hr>
<div class="col-8 m-auto">
<div class="text-center mt-3 mb-4">
        <a href="/users">
            <button class="btn btn-info">Voltar</button>
        </a>
    </div>
        @if(isset($errors) && count($errors)>0)
        <div class="text-center mt-4 mb-4 p-2 alert-danger">
            @foreach($errors->all() as $erro)
                {{$erro}}<br>
            @endforeach
        </div>
        @endif        
        
    @if(isset($tags))
        <form name="formEdit" id="formEdit" method="post" action="{{ url("users/$tags->id") }}">
        @method('PUT')
    @else
        <form name="formCad" id="formCad" method="post" action="{{url('users')}}">
    @endif
    
        @csrf
        <select class="form-control mt-3 mb-4" name="id_user" id="id_user">
            <option value="{{$tags->relUser->id ?? ''}}">{{$tags->relUser->name ?? 'Usuário'}}</option>
            @foreach($users as $user)
                <option value="{{$user->id}}">{{$user->name}}</option>
            @endforeach
        </select>
        <input class="form-control mt-3 mb-4" 
               type="text" 
               name="nome" 
               id="nome" 
               value="{{$tags->nome ?? ''}}" 
               placeholder="Nome Repositório">
        <input class="form-control mt-3 mb-4" 
               type="text" 
               name="language" 
               id="language" 
               value="{{$tags->language ?? ''}}" 
               placeholder="Linguagem">
        <input class="form-control mt-3 mb-4" 
               type="text" 
               name="image" 
               id="image" 
               value="{{$tags->image ?? ''}}" 
               placeholder="Link do Repositório">
               <img src="{{$tags->image  ?? ''}}" width="70" height="50">
               <hr>
        <input class="btn btn-primary mt-3 mb-4" 
               type="submit" 
               value="@if(isset($tags)) Editar @else Cadastrar @endif">
    </form>
</div>
@endsection