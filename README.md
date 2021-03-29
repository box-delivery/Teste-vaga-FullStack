# Teste-vaga-Backend - Yan de Paula
### Iniciando o projeto com laravel sail (docker):
1. Clone o repositório
2. Na pasta em que o projeto foi clonado use o comando `./vendor/bin/sail up -d` caso não queira usar o sail, certifique-se de estar com seus containeres up and running e configure o .env com as informações corretas.
3. Acesse o container da aplicação e use o comando `composer install`
4. Rode o comando `php artisan migrate`
5. Preencha a base de filmes com o comando `php artisan db:seed`
6. Use o comando `php artisan passport:install` para configurar as chaves do passport
7. Use o comando `php artisan test` para efetuar os testes
8. Acesse a [documentação](https://documenter.getpostman.com/view/4704378/TzCL99Gc "documentação") e use a API :)

### Iniciando o projeto sem docker:
1. Clone o repositório
2. Na pasta em que o projeto foi clonado use o comando `composer install`
3. Rode o comando `php artisan migrate`
4. Preencha a base de filmes com o comando `php artisan db:seed`
5. Use o comando `php artisan passport:install` para configurar as chaves do passport
6. Use o comando `php artisan test` para efetuar os testes
7. Acesse a [documentação](https://documenter.getpostman.com/view/4704378/TzCL99Gc "documentação") e use a API :)