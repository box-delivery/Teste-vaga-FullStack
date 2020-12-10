<p align="center"><img src="https://image.winudf.com/v2/image1/Y29tLmJveGRlbGl2ZXJ5LmNvdXJpZXJfaWNvbl8xNTUyNjI1NjIxXzAyNA/icon.png?w=170&fakeurl=1" width="150"></p>

<p align="center">
<a href="https://boxdelivery.com.br/licenca">Licença Owner</a>
</p>

## Teste Box Delivery

Neste repositório está o teste feito por Alexandre para a Empresa Box!!

- Vídeo com uma explicação rápida: 
```
https://www.youtube.com/watch?v=Y7icf-6w0Ow&ab_channel=AlexandreFerreira
```

- URL's de Acesso: 
```
baseURL + "/login"
baseURL + "/register"
baseURL + "/apiDocumentation"
baseURL + "/"
```

- Clone o projeto com o comando: 
```
git clone git@github.com:Shieldforce/Teste-vaga-PHP.git project
```

- Copie o arquivo .env.example para .env: [ cp .env.example .env ] se estiver usando o Bash ou Linux

- Atualize o composer:
```
 composer update
```

- Migre as tabelas de start do sistema:
```
 php artisan migrate:refresh --seed
```

- API JWT (Para criar o token inicial):
```
 php artisan jwt:secret
```


- Se algumas funções de sincronização não funcionarem (Já foi feito um overRide na função): Mude um arquivo dentro do core do Laravel com o namespace: 
```
vendor/laravel/framework/src/Illuminate/Database/Eloquent/Relations/Concerns
```
Classe: InteractsWithPivotTable, Método: sync(). Mude a variável de $detaching = true para $detaching = false. LINHA 83
```
public function sync($ids, $detaching = true)   para   public function sync($ids, $detaching = false)
```
E quando chamar o método dentro do sistema chame assim: $table->relation()->sync($ids, true); Isso é um bug que impede o método sync de sincronizar os ids dos relacionamentos em questão, já criei um issue no projeto do laravel para ver se eles consertam esse bug;

- Usuário Super Admin do Sistema (ACL -Permissões Gerais): 
```
user: 11111111111
pass: cnsa@020459
```

- Usuário Comum (ACL -Permissões no Painel): 
```
user: 22222222222
pass: cnsa@020459
```

- Usuário API (ACL -Permissões na API): 
```
user: 33333333333 
pass: cnsa@020459
```

## Correções PHPUnit Core in Laravel

- Class (PHPUnit_TextUI_Command)
```
Sumir com alertas (warning) Linha 277 and 285 Modify to "continue 2"
Rodar Teste Unitários com o comando: "vendor/bin/phpunit"

Funções de Teste de Rotas de API:
route_visit_api_logout();
route_visit_api_refresh_token();
route_visit_api_list_users();
route_visit_api_store_users();
route_visit_api_list_movies();
route_visit_api_favorite_movies();
route_visit_api_list_favorites_movies();
route_visit_api_delete_favorite_movies();
```


## Comandos comuns

- Iseed (https://github.com/orangehill/iseed)
...
php artisan iseed table --classnameprefix=PREFIX_
...

- Migrations Generator (https://github.com/kitloong/laravel-migrations-generator)
...
php artisan migrate:generate table1,table2,table3,table4,table5
... 

- Models Generator
...
php artisan krlove:generate:model User
php artisan krlove:generate:model User --table-name=user
... 

## Subir Projeto para VPS (Comandos necessários)
```
Passo 1 : $ ssh -p (porta) user@dominio.com.br
Passo 2 : $ cd /
Passo 3 : $ cd /home/pasta_do_projeto/public_html/
Passo 4 : $ $ git clone git@github.com:Shieldforce/Teste-vaga-PHP.git system
Passo 5 : $ cd system
Passo 6 : $ composer update
Passo 7 : $ cp .env.example .env
Passo 8 : $ sudo chmod -R 777 public/
Passo 9 : $ sudo chmod -R 777 storage/
Passo 10 : $ php artisan migrate:fresh --seed
Passo 11 : $ php artisan jwt:secret
```


## Equipe

Alexandre Ferreira do Nascimento


## License

Licença Proprietário: [ owner ](https://boxdelivery.com.br/licenca/licenca).
