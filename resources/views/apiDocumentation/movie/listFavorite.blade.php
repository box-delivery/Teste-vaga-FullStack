<div class="overflow-hidden content-section" id="content-get-characters">
    <h2 id="movie-listFavorite">Lista de Favoritos</h2>
    <pre>
    <code class="bash">
    # Exemplo de Requisição em PHP
    $curl = curl_init();
    curl_setopt_array($curl, array(
      CURLOPT_URL => 'http://teste-box/api/movie/listFavorite',
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
        <code class="higlighted">{{ route("movie.listFavorite") }}</code>
    </p>
    <br>
    <pre>
    <code class="json">
    Resultado Esperado :

    {
        "code": 20004,
        "status": "success",
        "message": "Lista de Favoritos mostrada com sucesso!",
        "data": {
            "current_page": 1,
            "data": [
                {
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
                    "pivot": {
                        "user_id": 12,
                        "movie_id": 1
                    }
                },
                {
                    "id": 6239,
                    "themoviedb_id": 586333,
                    "adult": 0,
                    "backdrop_path": "/zCAb4opafbOHgBx6n9Pv3OQpwD3.jpg",
                    "original_language": "es",
                    "original_title": "¿A quién te llevarías a una isla desierta?",
                    "overview": "Na última noite juntos, as vidas de quatro colegas de apartamento de longa data mudam repentinamente quando um segredo é revelado durante uma celebração.",
                    "popularity": "12.39",
                    "poster_path": "/f4mNHOpEbx68j0yaNdme6b07WPC.jpg",
                    "release_date": "2019-03-22",
                    "title": "Quem Você Levaria para uma Ilha Deserta?",
                    "video": "0",
                    "vote_average": "5.00",
                    "vote_count": 320,
                    "created_at": "2020-12-10T00:23:40.000000Z",
                    "updated_at": "2020-12-10T00:23:40.000000Z",
                    "pivot": {
                        "user_id": 12,
                        "movie_id": 6239
                    }
                }
            ],
            "first_page_url": "http://teste-box/api/movie/listFavorite?page=1",
            "from": 1,
            "last_page": 1,
            "last_page_url": "http://teste-box/api/movie/listFavorite?page=1",
            "next_page_url": null,
            "path": "http://teste-box/api/movie/listFavorite",
            "per_page": 20,
            "prev_page_url": null,
            "to": 2,
            "total": 2
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
        </tbody>
    </table>
</div>
