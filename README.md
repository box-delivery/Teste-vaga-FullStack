## Requisitos para executar a aplicação 
- Docker instalado
- Docker Compose instalado
- Conta no MovieDB

## Ferramentas utilizadas no desenvolvimento
- PHP 8
- Laravel 8
- MySQL 8
- Nginx 

## Comandos para criação do ambiente
- Entrar no diretório da aplicação
- cp .env.example .env
- Preencher as variaveis de ambientes MOVIE_DB_API_TOKEN e MOVIE_DB_API_URL de acordo com a sua conta
- docker-compose up -d
- docker exec -it app composer install
- docker exec -it app php artisan migrate --seed
- docker exec -it app php artisan key:generate

## Comando para rodar os testes da aplicação
- docker exec -it app php artisan test

## API Endpoints
Adicionar cabeçalho Accept igual application/json para todas as requisições abaixo
### GET /api/register
Exemplo de corpo da requisição
```json
{
    "name": "Flavio Alves",
	"email": "test@gmail.com",
	"password": "Senha;1234",
	"password_confirmation": "Senha;1234"
}
```
Retorno

```json
{
  "token": "1|S6k63VyobiLxlILG9JWkyOdUItgir8zAdSminxLy",
  "user": {
    "name": "Flavio Alves",
    "email": "test@gmail.com",
    "updated_at": "2020-12-04T23:09:05.000000Z",
    "created_at": "2020-12-04T23:09:05.000000Z",
    "id": 1
  }
}
```

### GET /api/login
Exemplo de corpo da requisição
```json
{
    "email": "test@gmail.com",
    "password": "senha1234"
}
```
Retorno

```json
{
  "token": "2|mTfz9sISsBSFNildkVYQsbTlZn3Ov3QfIThwFAB4",
  "user": {
    "id": 1,
    "name": "Flavio Alves",
    "email": "test@gmail.com",
    "created_at": "2020-12-04T23:09:05.000000Z",
    "updated_at": "2020-12-04T23:09:05.000000Z"
  }
}
```

#### Para acessar as rotas abaixo é necessário passar o cabeçalho Authorization com o valor Bearer {token}

### GET /api/movies
Retorno
```json
{
  "data": []
}
```

### PATCH /api/movies/{movie_id}/favorite
Favoritar o filme para o usuário logado

### PATCH /api/movies/{movie_id}/unfavorite
Desfavoritar o filme para o usuário logado

### GET /api/movies/favorite
Listar os filmes favoritos do usuário logado

Retorno

```json
{
  "data": []
}
```
