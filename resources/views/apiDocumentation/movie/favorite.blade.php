<div class="overflow-hidden content-section" id="content-get-characters">
    <h2 id="movie-favorite">Salvar Favorito</h2>
    <pre>
    <code class="bash">
    # Exemplo de Requisição em PHP
    $curl = curl_init();
    curl_setopt_array($curl, array(
      CURLOPT_URL => 'http://teste-box/api/movie/favorite/{movie_id | Obrigatório}',
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => '',
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => 'GET',
      CURLOPT_HTTPHEADER => array(
        'Authorization: Bearer {token}'
      ),
    ));
    $response = curl_exec($curl);
    curl_close($curl);
    echo $response;
    </code>
    </pre>
    <p>
        (GET) A URL de requisição para está ação é :<br>
        <code class="higlighted">{{ route("movie.favorite", ["movie_id"=>1]) }}</code>
    </p>
    <br>
    <pre>
    <code class="json">
    Resultado Esperado :

    {
        "code": 30001,
        "status": "success",
        "message": "Filme adicionado a lista de Favoritos!",
        "data": {
            "id": 1,
            "themoviedb_id": 590706,
            "adult": 0,
            "backdrop_path": "/jeAQdDX9nguP6YOX6QSWKDPkbBo.jpg",
            "original_language": "en",
            "original_title": "Jiu Jitsu",
            "overview": "Uma antiga ordem de experientes lutadores de Jiu Jitsu enfrenta temíveis invasores alienígenas em uma batalha pela Terra a cada seis anos.",
            "popularity": "2379.09",
            "poster_path": "/eLT8Cu357VOwBVTitkmlDEg32Fs.jpg",
            "release_date": "2020-11-20",
            "title": "Jiu Jitsu",
            "video": "0",
            "vote_average": "5.70",
            "vote_count": 123,
            "created_at": "2020-12-09T23:54:49.000000Z",
            "updated_at": "2020-12-09T23:54:49.000000Z",
            "users": []
        },
        "url": "panel.main.index"
    }
    </code>
    </pre>
    <h4>Parâmetros para esta requisição</h4>
    <table>
        <thead>
        <tr>
            <th>Campo</th>
            <th>Tipo</th>
            <th>Descrição</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td>Autorization</td>
            <td>Header</td>
            <td>(Obrigatório) Esté parâmetro é passado no Header (Bearer {token}) | Expira em 1 hora</td>
        </tr>
        <tr>
            <td>movie_id</td>
            <td>GET</td>
            <td>(Opcional) Esté parâmetro é passado na URL | ID do Filme</td>
        </tr>
        </tbody>
    </table>
</div>
