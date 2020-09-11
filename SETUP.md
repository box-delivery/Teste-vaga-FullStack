## Como instalar

Execute um clone do repositório

Utilizar banco de dados MySQL e criar base de dados com nome "movies"

> CREATE DATABASE movies;

Copiar o arquivo .env.exemple, renomear para .env e configurar o usuário e senha do banco de dados

Executar o comando para atualizar as dependencias do projeto:

> composer update

Após instalar todas as dependencias, gerar as tabelas e dados

> php artisan migrate
> php artisan db:seed

## Endpoints

Utilizando postman, insomnia ou outro da sua preferencia

### Registrar um novo usuário

POST /api/auth/register

headers:
    Content-Type: application/json
    
data: {
	"name": "Seu nome",
	"email": "seu_email@gmail.com",
	"password": "123456",
	"password_confirmation": "123456"
}

### Efetuar login

POST api/auth/login

headers:
    Content-Type: application/json

data: {
	"email": "seu_email@gmail.com",
	"password": "123456"
}

### Efetuar logout

POST /api/auth/logout

headers:
    Authorization: Bearer {token}

### Listar todos os filmes

GET /api/movies

headers:
    Authorization: Bearer {token}

### Listar todos filmes favoritos do usuário

GET /api/movies/favorites/{user_id}

headers:
    Authorization: Bearer {token}

### Adicionar um filme aos favoritos do usuário

POST /api/movies/favorites/{user_id}/add/{movie_id}

headers:
    Authorization: Bearer {token}

### Remover um filme dos favoritos do usuário

DELETE /api/movies/favorites/{user_id}/remove/{movie_id}

headers:
    Authorization: Bearer {token}
