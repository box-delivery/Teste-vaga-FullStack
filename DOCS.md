## Introdução

Olá, optei por fazer um código do zero sem a utilização de nenhum framework para facilitar a avaliação, assim eu imagino.

Conforme proposto fiz apenas a API, optei pelo Insomnia para utilizar e adicionei as consultas aqui no repositório para você poder importar e apenas executar as consultas.

## Instalação

Para instalar o projeto você vai precisar realizar os seguintes passos: 

1. Instalar as dependências via [composer](https://getcomposer.org/)

> $ composer install 

2. Criar o arquiv `.env` e informar os valores das chaves para estabelecer conexão com o banco de dados e com a API do The Movie DB

> $ cp .env.example .env

3. Executar a migração do banco de dados para criar a estrutura de tabelas: 

> $ vendor/bin/phinx migrate

## Executando o projeto

Uma vez configurado você pode executar o projeto ouvindo diretamente no PHP ou configurando-o dentro de um Apache/Nginx.

> $ php -S

## Bibliotecas utilizadas

- [PHP dotenv](https://github.com/vlucas/phpdotenv)
- [Phinx](https://github.com/cakephp/phinx)
- [PHRoute](https://github.com/mrjgreen/phroute)
- [Medoo](https://github.com/catfan/Medoo)
- [Guzzle](https://github.com/guzzle/guzzle)