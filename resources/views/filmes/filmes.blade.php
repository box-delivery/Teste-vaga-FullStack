<div>
@foreach($filmesLista as $f)
   <div>{{$f->nome}} ---- {{$f->Generos->genero}}</div>
@endforeach
</div>