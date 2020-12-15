# BoxDelivery
### Requisitos
- [Docker](https://www.docker.com/get-started)
- [Docker Compose](https://docs.docker.com/compose/install)

### Rodar local
- Acesse a pasta da aplicação, depois rode o comando a seguir:
- Linux: `./start.sh`
- Windows: `start.cmd`
- Abra [http://localhost](http://localhost)

## API DOC
- Ou importe o arquivo `BoxDelivery.postman_collection.json` no [Postman](https://www.postman.com/)


## End-point: Get Token
### Description:
Method: POST
>```
>{{base_url}}/api/user/token
>```
### Body formdata

|Param|value|Type|
|---|---|---|
|email|admin@admin.com|text|
|password|password|text|



⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃


## End-point: Create User
### Description:
Method: POST
>```
>{{base_url}}/api/user
>```
### Body formdata

|Param|value|Type|
|---|---|---|
|email|admin1@admin.com|text|
|password|password|text|
|name|admin|text|



⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃


## End-point: Movies
### Description:
Method: GET
>```
>{{base_url}}/api/movies?page=1
>```
### Query Params

|Param|value|
|---|---|
|page|1|


### 🔑 Authentication bearer

|Param|value|Type|
|---|---|---|
|token|{{api_token}}|string|



⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃


## End-point: User Favorites
### Description:
Method: GET
>```
>{{base_url}}/api/favorites?page=1
>```
### Query Params

|Param|value|
|---|---|
|page|1|


### 🔑 Authentication bearer

|Param|value|Type|
|---|---|---|
|token|{{api_token}}|string|


⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃


## End-point: Add User Favorite
### Description:
Method: POST
>```
>{{base_url}}/api/favorites
>```
### Body formdata

|Param|value|Type|
|---|---|---|
|movie_id|598|text|


### 🔑 Authentication bearer

|Param|value|Type|
|---|---|---|
|token|{{api_token}}|string|



⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃

## End-point: Remove User Favorite
### Description:
Method: DELETE
>```
>{{base_url}}/api/favorites
>```
### 🔑 Authentication bearer

|Param|value|Type|
|---|---|---|
|token|{{api_token}}|string|

----------------------------------------
## Objetivos
O objetivo do teste é conhecer as habilidades em:
- Programação PHP / Laravel
- Organização e estruturação de um projeto
- Análise/Entendimento de requisitos
- Qualidade do código
- Conhecimento em banco de dados
- Conhecimento de APIS restful
- Lógica

## Importante
Nenhum código desenvolvido nesse teste será utilizado de forma comercial. O objetivo aqui é apenas avaliar o conhecimento do candidato.

## O teste
Que tal desenvolvermos uma API de filmes favoritos para que as pessoas consigam fazer uma lista dos filmes que elas mais gostam?

### Então você vai precisar:
- Criar a estrutura de banco de dados
- Popular a tabela de filmes (recomendados consumir a API do The Movie DB)
- Criar sistema de autenticação para que o usuário se cadastre e consiga efetuar login
- Criar os endpoints para:
  - Cadastras usuário
  - Efetuar login para poder consumir o restante da API
  - Listar os filmes cadastrados no banco
  - Listar os filmes que o usuário salvou como favorito
  - Salvar um filme como favorito
  - Remover um filme da lista de favoritos do usuário
  
Não esqueça das validações!

### O que devo utilizar?
- Laravel 

### Plus
- Testes automatizados

### Como participar ?
- Fazer um fork deste repositório e enviar um pull request ao finalizar. Não esqueça de colocar as instruções para rodar o projeto.


# Boa sorte!
