# Teste-vaga-Backend - Yan de Paula

### Iniciando o projeto com laravel sail (docker):
1. Clone o repositório
1. Gere uma API_KEY no [The movie db](https://www.themoviedb.org/ "the movie db") e adiciona ele no .env em TMDB_KEY
1. use o comando `composer install`
1. Na pasta em que o projeto foi clonado use o comando `./vendor/bin/sail up -d` caso não queira usar o sail, certifique-se de estar com seus containeres up and running e configure o .env com as informações corretas.
1. Rode o comando `php artisan migrate`
1. Preencha a base de filmes com o comando `php artisan db:seed`
1. Use o comando `php artisan passport:install` para configurar as chaves do passport
1. Use o comando `php artisan key:generate` para gerar um APP_KEY no .env caso não tenha sido preenchido
1. Use o comando `php artisan test` para efetuar os testes
1. Acesse a [documentação](https://documenter.getpostman.com/view/4704378/TzCL99Gc "documentação") e use a API :)

### Iniciando o projeto sem docker:
1. Clone o repositório
1. Gere uma API_KEY no [The movie db](https://www.themoviedb.org/ "the movie db") e adiciona ele no .env em TMDB_KEY
1. Na pasta em que o projeto foi clonado use o comando `composer install`
1. Rode o comando `php artisan migrate`
1. Preencha a base de filmes com o comando `php artisan db:seed`
1. Use o comando `php artisan passport:install` para configurar as chaves do passport
1. Use o comando `php artisan key:generate` para gerar um APP_KEY no .env caso não tenha sido preenchido
1. Use o comando `php artisan test` para efetuar os testes
1. Acesse a [documentação](https://documenter.getpostman.com/view/4704378/TzCL99Gc "documentação") e use a API :)

