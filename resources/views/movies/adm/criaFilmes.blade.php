@extends('movies.template.pagina1')


@section('conteudo')

    <div id='criaFilmes'>
            <form action="{{url('filmes/cadastrar')}}" method='post'  enctype="multipart/form-data">
            {{ csrf_field() }}
            <p>
            <select name="generos_id" id="">
            @foreach($gen as $g)
                <option value="{{$g->id}}">{{$g->genero}}</option>
            @endforeach
            </select>
            </p>
            <p><input type="text" required="required" name="nome" placeholder="nome do filme"></p>
            <p>
                <select name="ano" id="">
                    @foreach($ano as $a)
                        <option value="{{$a}}">{{$a}}</option>
                    @endforeach
                </select>
            </p>

            <p><input type="file" required="required"  name="imagem" placeholder="imagem"></p>
            <p><label for="">sinopse</label><textarea required="required"  name="sinopse" id="" cols="30" rows="10" ></textarea></p>
            <p><input type="submit" value="criar"></p>
            </form>
    </div>
@stop