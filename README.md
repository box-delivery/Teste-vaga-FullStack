## API de lista de filmes preferidos

## Requisitos
  - Docker, ou 
  - PHP 7.4+ (instalado localmente com Composer)

## Como rodar (usando docker, em um ambiente Linux)
 - faça clone do repositório em uma pasta local
 - copie o arquivo `.env.example` para `.env` (não é necessário alterar nenhum parâmetro)
 - execute `docker build -t apitest` na pasta raiz
 - defina as variáveis de ambiente
   - `export IMAGETAG=apitest` (mesma tag usada no `build` acima)
   - `export MOVIE_DB_API_KEY=xxx` (substituindo `xxx` pela sua chave)
 - execute `./run.sh` (Linux) ou `run.bat` (Windows)
   - serão criadas as chaves da aplicação e do JWT
   - também serão cadastrados 20 filmes aleatórios do THE MOVIE DB (pode alterar a quantidade editando o arquivo `run.sh`)
   - no arquivo `run.bat`, o nome da imagem está fixada como `apifilmes` 
 - a aplicação estará acessível `http://127.0.0.1:8000/api`
 
## Como rodar (sem docker)

Requer PHP 7.4+ e Composer instalados localmente

 - faça clone do repositório em uma pasta local
 - copie o arquivo `.env.example` para `.env` (não é necessário alterar nenhum parâmetro)
 - inclua a linha `MOVIE_DB_API_KEY=xxx` no arquivo `.env` (substituindo `xxx` pela sua chave)
 - execute os comandos:
   - `composer install`
   - `php artisan migrate`
   - `php artisan key:generate`
   - `php artisan jwt:secret --force`
   - `php artisan movies:fill 20` (para preencher banco com 20 filmes aleatórios)
   - `php artisan serve`
 - a aplicação estará acessível `http://127.0.0.1:8000/api`
 
## Endpoints

Método | Endpoint | Descrição | Parâmetros
---|---|---|---
POST | /users | Cria um novo usuário | - name<br>- email<br>- password (min: 12)
POST | /auth/login | Autentica na API | - email<br>- password
GET | /movies | Lista os filmes cadastrados no sistema | 
GET | /users/current/movies | Lista os filmes preferidos do usuário atual | 
PUT | /users/current/movies | Adiciona um filme à lista do usuário atual | - movie_id 
DELETE | /users/current/movies/{movie_id} | Remove um filme da lista do usuário atual | 

## Insomnia

O repositório inclui o arquivo `insomnia.json` que pode ser importado no Insomnia
para testes da API.

As definições de cada request que necessita de autenticação já incluem uma chamada 
automática ao endpoint de autenticação caso o token JWT esteja vencido.
 
## Testes automatizados

Após clonar o código, se tiver `PHP 7.4+` e `composer` configurado na máquina,
execute na raiz do projeto:
 - `composer install`
 - `vendor/bin/phpunit`
 
Se o container estiver em execução, também é possível rodar os testes através
do Docker, executando:
 - `docker exec {container_id} vendor/bin/phpunit --testdox`
 
(o parâmetro `--testdox` acima é opcional, porém facilita a visualização dos testes efetuados)
