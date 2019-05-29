<html>
  <head>
      <title> @yield('titulo')</title>
      <link rel="stylesheet" href="<?php echo asset('css/reset.css')?>" type="text/css">
      <link rel="stylesheet" href="<?php echo asset('css/paginas.css')?>" type="text/css">
  </head>
<body>
    <nav id="navigation">
        <ul>
            <li><a href="{{url('/cadastro')}}">registro</a></li>
            <li><a href="{{url('/filmes')}}">meus filmes</a></li>
            <li><a href="{{url('/filmes/favoritos')}}">favoritos</a></li>
            <li><a href="{{url('/filmes/cria')}}">cadastrar filme</a></li>
            <li><a href="{{url('/filmes/generos')}}">generos</a></li>
        </ul>
    </nav>
    <main>
       @yield('conteudo')
    </main>
    
    
<script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script> 
@yield('js')
</body>
</html>