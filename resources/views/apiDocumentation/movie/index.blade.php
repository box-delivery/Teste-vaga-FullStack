<div class="overflow-hidden content-section" id="content-get-characters">
    <h2 id="movie-index">Lista de Filmes</h2>
    <pre>
    <code class="bash">
    # Exemplo de Requisição em PHP
    $curl = curl_init();
    curl_setopt_array($curl, array(
      CURLOPT_URL => 'http://teste-box/api/movie/index/{paginate | Opcional - Default = 20}',
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
        <code class="higlighted">{{ route("movie.index") }}</code>
    </p>
    <br>
    <pre>
    <code class="json">
    Resultado Esperado :

    {
        "code": 50000,
        "status": "success",
        "message": "Lista de Filmes mostrada com sucesso!",
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
                    "updated_at": "2020-12-09T23:54:49.000000Z"
                },
                {
                    "id": 2,
                    "themoviedb_id": 671583,
                    "adult": 0,
                    "backdrop_path": "/vam9VHLZl8tqNwkp1zjEAxIOrkk.jpg",
                    "original_language": "en",
                    "original_title": "Upside-Down Magic",
                    "overview": "Nory Horace, de dez anos, é uma Fluxer e, como a maioria das Fluxers, pode se transformar em animais. Mas toda vez que Nory tenta se transformar em um gatinho preto, ela acaba se transformando em uma louca combinação de animais, como um gatinho castor ou até um gatinho dragão. Ela é enviada para morar com sua tia, para poder frequentar uma escola com uma nova turma para crianças que, como Nory, têm uma magia invertida que não se encaixa perfeitamente em uma das cinco categorias estabelecidas de mágica. Desesperado para ser normal, Nory aprende o quão valioso ser diferente pode ser.",
                    "popularity": "2323.20",
                    "poster_path": "/85xRkj1We6wRzdvnU59Old7TrDP.jpg",
                    "release_date": "2020-07-31",
                    "title": "Magia Invertida",
                    "video": "0",
                    "vote_average": "7.70",
                    "vote_count": 68,
                    "created_at": "2020-12-09T23:54:49.000000Z",
                    "updated_at": "2020-12-09T23:54:49.000000Z"
                },
                {
                    "id": 3,
                    "themoviedb_id": 602211,
                    "adult": 0,
                    "backdrop_path": "/ckfwfLkl0CkafTasoRw5FILhZAS.jpg",
                    "original_language": "en",
                    "original_title": "Fatman",
                    "overview": "Enquanto um Papai Noel desordeiro e nada ortodoxo luta contra a falência de seus negócios, um inconformado garoto de doze anos contrata um assassino para matar o Bom Velhinho como forma de vingança após receber um pedaço de carvão de presente de Natal.",
                    "popularity": "1819.92",
                    "poster_path": "/WhAfI9GIgrOF4rasrtmvWOrjnX.jpg",
                    "release_date": "2020-11-13",
                    "title": "Entre Armas e Brinquedos",
                    "video": "0",
                    "vote_average": "6.10",
                    "vote_count": 123,
                    "created_at": "2020-12-09T23:54:50.000000Z",
                    "updated_at": "2020-12-09T23:54:50.000000Z"
                },
                {
                    "id": 4,
                    "themoviedb_id": 454433,
                    "adult": 0,
                    "backdrop_path": "/mZgbq4Zpxz7ozWXl4asj6vNdlIi.jpg",
                    "original_language": "en",
                    "original_title": "Magic Camp",
                    "overview": "Um grupo de campistas desajustados ajuda um mágico azarado a redescobrir seu amor pela mágica, uma comédia emocionante sobre encontrar alegria e confiança na autoaceitação.",
                    "popularity": "1601.99",
                    "poster_path": "/q9HpD5BzdWtIYAplALJ3x2FdVne.jpg",
                    "release_date": "2020-08-14",
                    "title": "Magic Camp",
                    "video": "0",
                    "vote_average": "7.00",
                    "vote_count": 104,
                    "created_at": "2020-12-09T23:54:50.000000Z",
                    "updated_at": "2020-12-09T23:54:50.000000Z"
                },
                {
                    "id": 5,
                    "themoviedb_id": 577922,
                    "adult": 0,
                    "backdrop_path": "/wzJRB4MKi3yK138bJyuL9nx47y6.jpg",
                    "original_language": "en",
                    "original_title": "Tenet",
                    "overview": "Armado com apenas uma palavra – Tenet – e lutando pela sobrevivência do mundo inteiro, o Protagonista viaja através de um mundo crepuscular de espionagem internacional em uma missão que irá desenrolar em algo para além do tempo real.",
                    "popularity": "1387.92",
                    "poster_path": "/k68nPLbIST6NP96JmTxmZijEvCA.jpg",
                    "release_date": "2020-08-22",
                    "title": "Tenet",
                    "video": "0",
                    "vote_average": "7.40",
                    "vote_count": 2729,
                    "created_at": "2020-12-09T23:54:50.000000Z",
                    "updated_at": "2020-12-09T23:54:50.000000Z"
                },
                {
                    "id": 6,
                    "themoviedb_id": 729648,
                    "adult": 0,
                    "backdrop_path": "/zKv7KF0pH9ASv2uGgTvTylMlxQn.jpg",
                    "original_language": "en",
                    "original_title": "The Dalton Gang",
                    "overview": "Quando seu irmão é morto por um fora da lei, três irmãos Dalton se juntam ao departamento do xerife. Quando são enganados pela lei, recorrem ao crime. Tentando superar Jesse James, eles tentam roubar dois bancos de uma vez em 1892. As coisas ficam feias.",
                    "popularity": "1331.88",
                    "poster_path": "/cw0izcXHFuOGwgaVmdoYZL6lDyf.jpg",
                    "release_date": "2020-11-02",
                    "title": "Do Outro Lado da Lei",
                    "video": "0",
                    "vote_average": "4.80",
                    "vote_count": 19,
                    "created_at": "2020-12-09T23:54:50.000000Z",
                    "updated_at": "2020-12-09T23:54:50.000000Z"
                },
                {
                    "id": 7,
                    "themoviedb_id": 724989,
                    "adult": 0,
                    "backdrop_path": "/86L8wqGMDbwURPni2t7FQ0nDjsH.jpg",
                    "original_language": "en",
                    "original_title": "Hard Kill",
                    "overview": "O trabalho do bilionário CEO de tecnologia Donovan Chalmers (Willis) é tão valioso que ele contrata mercenários para protegê-lo e um grupo terrorista sequestra sua filha apenas para obtê-lo.",
                    "popularity": "1187.07",
                    "poster_path": "/ugZW8ocsrfgI95pnQ7wrmKDxIe.jpg",
                    "release_date": "2020-10-23",
                    "title": "Hard Kill",
                    "video": "0",
                    "vote_average": "5.00",
                    "vote_count": 228,
                    "created_at": "2020-12-09T23:54:50.000000Z",
                    "updated_at": "2020-12-09T23:54:50.000000Z"
                },
                {
                    "id": 8,
                    "themoviedb_id": 682377,
                    "adult": 0,
                    "backdrop_path": "/fTDzKoQIh1HeyjfpG5AHMi2jxAJ.jpg",
                    "original_language": "en",
                    "original_title": "Chick Fight",
                    "overview": "Quando Anna Wyncomb é apresentada a um submundo de luta feminina para lidar com toda a bagunça que está a sua vida, ela percebe que está mais conectada à história do clube do que imaginava, redescobrindo a si mesma, sua força interior e seu verdadeiro propósito.",
                    "popularity": "1112.62",
                    "poster_path": "/4ZocdxnOO6q2UbdKye2wgofLFhB.jpg",
                    "release_date": "2020-11-13",
                    "title": "Chick Fight",
                    "video": "0",
                    "vote_average": "5.90",
                    "vote_count": 50,
                    "created_at": "2020-12-09T23:54:51.000000Z",
                    "updated_at": "2020-12-09T23:54:51.000000Z"
                },
                {
                    "id": 9,
                    "themoviedb_id": 654028,
                    "adult": 0,
                    "backdrop_path": "/cq4h43quHugpsSoy5VCtJeihu64.jpg",
                    "original_language": "en",
                    "original_title": "The Christmas Chronicles: Part Two",
                    "overview": "Revoltada com o novo relacionamento da mãe, Kate foge e vai parar no Polo Norte, onde um elfo faz planos de cancelar o Natal.",
                    "popularity": "874.19",
                    "poster_path": "/axIreLP9hr0ENvr5kR1sncxuYue.jpg",
                    "release_date": "2020-11-18",
                    "title": "Crônicas de Natal: Parte Dois",
                    "video": "0",
                    "vote_average": "7.10",
                    "vote_count": 219,
                    "created_at": "2020-12-09T23:54:51.000000Z",
                    "updated_at": "2020-12-09T23:54:51.000000Z"
                },
                {
                    "id": 10,
                    "themoviedb_id": 337401,
                    "adult": 0,
                    "backdrop_path": "/qAKvUu2FSaDlnqznY4VOp5PmjIF.jpg",
                    "original_language": "en",
                    "original_title": "Mulan",
                    "overview": "Hua Mulan é a espirituosa e determinada filha mais velha de um honrado guerreiro. Quando o Imperador da China emite um decreto que um homem de cada família deve servir no exército imperial, Mulan decide tomar o lugar de seu pai, que está doente. Assumindo a identidade de Hua Jun, ela se disfarça de homem para combater os invasores que estão atacando sua nação, provando-se uma grande guerreira.",
                    "popularity": "851.44",
                    "poster_path": "/72I82eKXCadZWEYygV9GkJOQNEq.jpg",
                    "release_date": "2020-09-04",
                    "title": "Mulan",
                    "video": "0",
                    "vote_average": "7.20",
                    "vote_count": 3305,
                    "created_at": "2020-12-09T23:54:51.000000Z",
                    "updated_at": "2020-12-09T23:54:51.000000Z"
                },
                {
                    "id": 11,
                    "themoviedb_id": 671039,
                    "adult": 0,
                    "backdrop_path": "/gnf4Cb2rms69QbCnGFJyqwBWsxv.jpg",
                    "original_language": "fr",
                    "original_title": "Bronx",
                    "overview": "Marselha. Tudo começa com a carnificina causada pelos homens do clã Orsoni. Richard Vronski, um policial da brigada anti-gangue com métodos pouco ortodoxos, se vê encarregado da investigação, enfrentando seus rivais, comandados por Costa, major da polícia. Um novo diretor, o comissário Angel Leonetti chega para dominar os cães loucos de sua equipe. Mas todos perceberão rapidamente que não se recebe nada sem sacrifícios ou riscos.",
                    "popularity": "831.79",
                    "poster_path": "/hSpm2mMbkd0hLTRWBz0zolnLAyK.jpg",
                    "release_date": "2020-10-30",
                    "title": "Bronx",
                    "video": "0",
                    "vote_average": "5.80",
                    "vote_count": 277,
                    "created_at": "2020-12-09T23:54:51.000000Z",
                    "updated_at": "2020-12-09T23:54:51.000000Z"
                },
                {
                    "id": 12,
                    "themoviedb_id": 524047,
                    "adult": 0,
                    "backdrop_path": "/2Fk3AB8E9dYIBc2ywJkxk8BTyhc.jpg",
                    "original_language": "en",
                    "original_title": "Greenland",
                    "overview": "Quando cientistas descobrem que um cometa atingirá a Terra em poucos dias e provavelmente causará a extinção da humanidade, uma família tenta cruzar o país para chegar a sua única esperança de sobrevivência: um grupo de abrigos subterrâneos em Greenland.",
                    "popularity": "816.37",
                    "poster_path": "/sJecw4UYpvTgKE2zS9le44Nwuag.jpg",
                    "release_date": "2020-07-29",
                    "title": "Destruição Final: O Último Refúgio",
                    "video": "0",
                    "vote_average": "7.20",
                    "vote_count": 884,
                    "created_at": "2020-12-09T23:54:51.000000Z",
                    "updated_at": "2020-12-09T23:54:51.000000Z"
                },
                {
                    "id": 13,
                    "themoviedb_id": 581392,
                    "adult": 0,
                    "backdrop_path": "/gEjNlhZhyHeto6Fy5wWy5Uk3A9D.jpg",
                    "original_language": "ko",
                    "original_title": "반도",
                    "overview": "A península coreana ficou devastada após o surto de zumbis que atingiu os passageiros de um trem-bala com destino a Busan há quatro anos. Com isso, um ex-soldado que conseguiu fugir do país, Jung-seok, tem a missão de retornar e acaba encontrando alguns sobreviventes.",
                    "popularity": "742.79",
                    "poster_path": "/dGVUiqnahQ4ZZRchGRpO2SyhtQY.jpg",
                    "release_date": "2020-07-15",
                    "title": "Invasão Zumbi 2: Península",
                    "video": "0",
                    "vote_average": "6.90",
                    "vote_count": 875,
                    "created_at": "2020-12-09T23:54:51.000000Z",
                    "updated_at": "2020-12-09T23:54:51.000000Z"
                },
                {
                    "id": 14,
                    "themoviedb_id": 741067,
                    "adult": 0,
                    "backdrop_path": "/aO5ILS7qnqtFIprbJ40zla0jhpu.jpg",
                    "original_language": "en",
                    "original_title": "Welcome to Sudden Death",
                    "overview": "Jesse Freeman é um ex-oficial das forças especiais e especialista em explosivos agora trabalhando regularmente como segurança em uma arena de basquete de última geração. Problemas irromperem quando um grupo de terroristas sequestra o dono da equipe e a filha de Jesse durante a noite de estreia. Enfrentando um relógio de tique-taque e probabilidades impossíveis, cabe a Jesse não apenas salvá-los, mas também uma casa cheia de fãs neste thriller de ação altamente carregado.",
                    "popularity": "708.94",
                    "poster_path": "/elZ6JCzSEvFOq4gNjNeZsnRFsvj.jpg",
                    "release_date": "2020-09-29",
                    "title": "Welcome to Sudden Death",
                    "video": "0",
                    "vote_average": "6.30",
                    "vote_count": 184,
                    "created_at": "2020-12-09T23:54:51.000000Z",
                    "updated_at": "2020-12-09T23:54:51.000000Z"
                },
                {
                    "id": 15,
                    "themoviedb_id": 531219,
                    "adult": 0,
                    "backdrop_path": "/8rIoyM6zYXJNjzGseT3MRusMPWl.jpg",
                    "original_language": "en",
                    "original_title": "Roald Dahl's The Witches",
                    "overview": "Um menino acaba descobrindo uma conferência de bruxas enquanto fica com a avó em um hotel e é transformado em rato pela Grande Bruxa.",
                    "popularity": "707.54",
                    "poster_path": "/kQDfB6dPYoiuUtbSYusNopSXyVp.jpg",
                    "release_date": "2020-10-26",
                    "title": "Convenção das Bruxas",
                    "video": "0",
                    "vote_average": "6.90",
                    "vote_count": 877,
                    "created_at": "2020-12-09T23:54:52.000000Z",
                    "updated_at": "2020-12-09T23:54:52.000000Z"
                },
                {
                    "id": 16,
                    "themoviedb_id": 635302,
                    "adult": 0,
                    "backdrop_path": "/d1sVANghKKMZNvqjW0V6y1ejvV9.jpg",
                    "original_language": "ja",
                    "original_title": "劇場版「鬼滅の刃」無限列車編",
                    "overview": "Tanjiro Kamado, junto com Inosuke Hashibira, um garoto criado por javalis que usa uma cabeça de javali, e Zenitsu Agatsuma, um garoto assustado que revela seu verdadeiro poder quando dorme, embarca no Trem Infinito em uma nova missão com o Hashira de Fogo, Kyojuro Rengoku, para derrotar um demônio que tem atormentado o povo e matado os caçadores de oni que se opõem a ele!",
                    "popularity": "575.16",
                    "poster_path": "/m9cn5mhW519QKr1YGpGxNWi98VJ.jpg",
                    "release_date": "2020-10-16",
                    "title": "Demon Slayer: O Trem Infinito",
                    "video": "0",
                    "vote_average": "6.10",
                    "vote_count": 94,
                    "created_at": "2020-12-09T23:54:52.000000Z",
                    "updated_at": "2020-12-09T23:54:52.000000Z"
                },
                {
                    "id": 17,
                    "themoviedb_id": 694919,
                    "adult": 0,
                    "backdrop_path": "/pq0JSpwyT2URytdFG0euztQPAyR.jpg",
                    "original_language": "en",
                    "original_title": "Money Plane",
                    "overview": "Um ladrão profissional com dívidas de 40 milhões de dólares deve cometer um último golpe - roubar um cassino aéreo futurista cheio dos criminosos mais perigosos do mundo.",
                    "popularity": "569.12",
                    "poster_path": "/6CoRTJTmijhBLJTUNoVSUNxZMEI.jpg",
                    "release_date": "2020-09-29",
                    "title": "Money Plane",
                    "video": "0",
                    "vote_average": "5.90",
                    "vote_count": 200,
                    "created_at": "2020-12-09T23:54:52.000000Z",
                    "updated_at": "2020-12-09T23:54:52.000000Z"
                },
                {
                    "id": 18,
                    "themoviedb_id": 497582,
                    "adult": 0,
                    "backdrop_path": "/kMe4TKMDNXTKptQPAdOF0oZHq3V.jpg",
                    "original_language": "en",
                    "original_title": "Enola Holmes",
                    "overview": "Enola Holmes só tem 16 anos, mas vai fazer de tudo para encontrar a mãe desaparecida, inclusive despistar o irmão Sherlock e ajudar um jovem lorde fugitivo.",
                    "popularity": "561.87",
                    "poster_path": "/mmRu2io9K21RioNDEWgE2eD88gR.jpg",
                    "release_date": "2020-09-23",
                    "title": "Enola Holmes",
                    "video": "0",
                    "vote_average": "7.50",
                    "vote_count": 2839,
                    "created_at": "2020-12-09T23:54:53.000000Z",
                    "updated_at": "2020-12-09T23:54:53.000000Z"
                },
                {
                    "id": 19,
                    "themoviedb_id": 400160,
                    "adult": 0,
                    "backdrop_path": "/wu1uilmhM4TdluKi2ytfz8gidHf.jpg",
                    "original_language": "en",
                    "original_title": "The SpongeBob Movie: Sponge on the Run",
                    "overview": "Onde está Gary? Segundo Bob Esponja, Gary foi \"caracolstrado\" pelo temível Rei Poseidon e levado para a cidade perdida de Atlantic City. Junto a Patrick Estrela, ele sai em uma missão de resgate ao querido amigo, e nesta jornada os dois vão conhecer novos personagens e viver inimagináveis aventuras.",
                    "popularity": "561.45",
                    "poster_path": "/d88x4Jnyhr4xErOYeJCspcxI34h.jpg",
                    "release_date": "2020-08-14",
                    "title": "Bob Esponja: O Incrível Resgate",
                    "video": "0",
                    "vote_average": "8.00",
                    "vote_count": 1681,
                    "created_at": "2020-12-09T23:54:53.000000Z",
                    "updated_at": "2020-12-09T23:54:53.000000Z"
                },
                {
                    "id": 20,
                    "themoviedb_id": 340102,
                    "adult": 0,
                    "backdrop_path": "/2AFZyra0Ddwl2oBDhClvD1qSIL6.jpg",
                    "original_language": "en",
                    "original_title": "The New Mutants",
                    "overview": "Cinco jovens mutantes descobrem o alcance de seus poderes e lidam com traumas do passado enquanto são mantidos presos contra a vontade num sinistro hospital.",
                    "popularity": "517.45",
                    "poster_path": "/6RcWaW43UWIJzhIp6bcmui2efd.jpg",
                    "release_date": "2020-08-26",
                    "title": "Os Novos Mutantes",
                    "video": "0",
                    "vote_average": "6.40",
                    "vote_count": 1009,
                    "created_at": "2020-12-09T23:54:53.000000Z",
                    "updated_at": "2020-12-09T23:54:53.000000Z"
                }
            ],
            "first_page_url": "http://teste-box/api/movie/index/20?page=1",
            "from": 1,
            "last_page": 500,
            "last_page_url": "http://teste-box/api/movie/index/20?page=500",
            "next_page_url": "http://teste-box/api/movie/index/20?page=2",
            "path": "http://teste-box/api/movie/index/20",
            "per_page": "20",
            "prev_page_url": null,
            "to": 20,
            "total": 10000
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
            <td>paginate</td>
            <td>GET</td>
            <td>(Opcional) Esté parâmetro é passado na URL | Valor padrão = 20</td>
        </tr>
        </tbody>
    </table>
</div>
