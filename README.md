## Instalando o projeto
- Clone o repositório.
- Execute o comando `composer install` no diretório do projeto.
- Copie o arquivo `.env.example` para um novo arquivo `.env`.
- Preencha neste novo arquivo as variáveis de ambiente abaixo com os dados do seu banco de dados e API do MovieDB.
```
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=test
    DB_USERNAME=root
    DB_PASSWORD=password123
    
    MOVIE_DB_KEY=
```
- Execute o comando `php artisan key:generate`.

## Laravel Passport
Para utilizar a autenticação OAuth, é necessário instalar o Passport do Laravel, para isso execute o comando: `php artisan passport:install`

## Preparando o banco de dados
Com o banco de dados configurado na etapa anterior, rode as migrations para montar a estrutura do projeto:
`php artisan migrate`

### Preenchendo a tabela de filmes com a API do MovieDB
Com a estrutura montada, vamos preencher a tabela de filmes com os 20 filmes mais berm avaliados do MovieDB, para isso, execute o comando artisan:
`php artisan movies:fill`

## Rodando o projeto
Para rodar o projeto, você pode utilizar o comando: `php artisan serve`

## Endpoints
Agora o projeto está configurado, abaixo estão os endpoints para cada operação.

#### Registrar Usuário
##### POST - /api/register

```json
// Request
{
	"name": "Lucas Souza",
	"email": "lcacao10@gmail.com",
	"password": "123"
}

// Response
{
  "token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiIzIiwianRpIjoiZTQ4N..."
}
```
#### Logar
##### POST - /api/login

```json
// Request
{
	"email": "lcacao10@gmail.com",
	"password": "123"
}

// Response
{
  "token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiIzIiwianRpIjoiZTQ4N..."
}
```
  
    

### As rotas a seguir necessitam autenticação, portanto, é importante adicionar alguns parametros ao seu header:
```json
"Accept": "application/json"
"Authorization": "Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9eyJ0eXAiOiJ9..." // Token obtido no endpoint de login
```

#### Listar filmes
##### GET - /api/movies
```json
// Request
// Não há corpo para este request

// Response
{
  "token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiIzIiwianRpIjoiZTQ4N..."
}
```

#### Favoritar filmes
##### POST - /api/movies/favorite
```json
// Request
{
	"movieId": 6
}

// Response
{
  "success": true,
  "data": {
    "user_id": 5,
    "movie_id": 6,
    "updated_at": "2020-12-14T13:31:14.000000Z",
    "created_at": "2020-12-14T13:31:14.000000Z",
    "id": 3
  }
}
```

#### Listar filmes favoritos
##### GET - /api/movies/favorites
```json
// Request
// Não há corpo para este request

// Response
{
  "success": true,
  "data": [
    {
      "id": 3,
      "title": "Dilwale Dulhania Le Jayenge",
      "overview": "Raj e Simran são dois jovens indianos vivendo em Londres que, acidentalmente, se conhecem durante uma viagem pela Europa. Eles se apaixonam...",
      "poster_url": "\/2CAL2433ZeIihfX1Hb2139CX0pW.jpg",
      "rating": 8.7,
      "created_at": "2020-12-14T13:31:14.000000Z",
      "updated_at": "2020-12-14T13:31:14.000000Z",
      "user_id": 5,
      "movie_id": 6
    }
  ]
}
```

#### Remover um filme favorito
##### DELETE - /api/movies/favorite
```json
// Request
{
	"movieId": 6
}

// Response
{
  "success": true,
  "message": "Favorito removido"
}
```

### Testes
Para rodas os testes automatizados, basta executar no diretório do projeto o comando `.\vendor\bin\phpunit`
