@extends('admin.layouts.app')

@section('title', 'Admin User - Github')

@section('content')
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
<div class="col-8 m-auto">
    @csrf
    <div class="text-center mt-3 mb-4">
        <a href="{{url('users/create')}}">
            <button class="btn btn-success">Cadastrar</button>
        </a>
    </div>
    <table class="table text-center">
        <thead class="thead-dark">
            <tr>
                <th>Id</th>
                <th>id_user</th>
                <th>nome</th>
                <th>language</th>
                <th>Image</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($tag as $tags)
            @php
            $user=$tags->find($tags->id)->relUser;
            @endphp
            <tr>
                <th scope="row">{{$tags->id}}</th>
                <td>{{$tags->id_user}} - {{$user->name}}</td>
                <td>{{$tags->nome}}</td>
                <td>{{$tags->language}}</td>
                <td><img src="{{$tags->image}}" width="70" height="50"></td>
                <td  width="200">
                    <a href="{{ url("users/$tags->id") }}"> <button class="btn btn-light fa far fa-eye"></button> </a>
                    <a href="{{ url("users/$tags->id/edit") }}"> <button class="btn btn-primary fa fas fa-edit"></button> </a>
                    <a href="{{url("users/$tags->id")}}" class="js-del">
                        <button class="btn btn-danger fa fas fa-eraser"></button>
                    </a>
                </td>
            </tr>

            @endforeach

        </tbody>
    </table>
</div>
@endsection