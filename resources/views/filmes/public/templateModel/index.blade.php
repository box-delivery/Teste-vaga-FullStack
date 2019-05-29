<html>
  <head>
      <title> @yield('titulo')</title>
      <link rel="stylesheet" href="<?php echo asset('css/paginas.css')?>" type="text/css">
  </head>
<body>
    <nav>
        <ul>
            <li>registro</li>
            <li>meus filmes</li>
            <li>favoritos</li>
        </ul>
    </nav>
    <main>
       @yield('conteudo')
    </main>
    
    
    <script
  src="https://code.jquery.com/jquery-3.4.1.min.js"
  integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
  crossorigin="anonymous"></script>
    <script src=<?php echo asset('js/filmes.js')?>></script>
</body>
</html>