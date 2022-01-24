# Instruções

O Projeto foi feito utilizando o Framework Laravel na versão 8 com PHP na Versão 7.4

Para a execução do projeto deve-se clonar o repositório e executar o comando
```
composer install
```

Após a instalação de todas as dependências verifique se o arquivo `.env` foi 
criado.   
   
Caso não tenha sido criado, copiar todo o conteúdo do arquivo `.env.example` para um novo arquivo chamado `.env`   

Após a criação do arquivo, verifique que os parametros de conexão com o banco de dados estejam corretamente configurados   
   
Após a configuração dos dados de acesso ao Banco de Dados, através do terminal, executar os seguintes comandos:   

`php artisan migrate` Para criar a estrutura necessária no banco de dados   
`php artisan populate:movies` Para popular a tabela de filmes no banco de dados

Após a criação das tabelas e da população da tabela de filmes, é possível se cadastrar pela interface web e utilizar os mesmos dados de acesso para consumo via API

As rotas utilizadas na API estão disponíveis através do comando `php artisan route:list` e também neste documento com o que é esperado

Requisição de exemplo para a rota `api/v1/user` 
```
curl --location --request GET 'app.box-delivery/api/v1/user' \
--header 'Authorization: Bearer 1|74wsY1RtI2A0IvdtUGtRxQd37ZrKuscxVu4fbXV1'
```

| Rota | Método | Protegida | Parametros | Header | 
|------|--------|-----------|------------|--------|
| api/v1/register | POST | Não | name,email,password,password_confirm | Não |
| api/v1/login | POST | Não | email,password | Não |
| api/v1/user | GET | Sim | Nenhum | Sim, Token fornecido no Login |
| api/v1/logout | POST | Sim | Nenhum | Sim, Token fornecido no Login |
| api/v1/movies/list | GET | Sim | Nenhum | Sim, Token fornecido no Login |
| api/v1/favorites/list | GET | Sim | Nenhum | Sim, Token fornecido no Login |
| api/v1/favorites/toggle | POST | Sim | movie_id Fornecido na listagem de filmes | Sim, Token fornecido no Login |

