# Teste-Desenvolvimento-Box-Delivery

---
## Subindo o Docker para rodar o app
1. **sudo docker-compose build app**
2. **sudo docker-compose up -d**
3. ![Título da imagem](public/img/rodar-docker.png)

---
## Instalar as dependências do composer
4. **sudo docker-compose exec app composer install**
---

## crie uma chave para o artisan
5. **sudo docker-compose exec app php artisan key:generate**
![Título da imagem](public/img/key-generate.png)
---

## Verifique o host do mysql que o Docker gerou

Comando no terminal:

6.0. **sudo docker ps**

![Título da imagem](public/img/docker-ps.png)


6.1. **sudo docker inspect _id do mysql_**

![Título da imagem](public/img/docker-inspect.png)

6.3. Copie o numero do IPAddress 
* Ex:  _172.23.0.2database_
---

## Edit o host do mysql
7. **Abra o arquivo database.php linha 49 e coloque o host que o docker gerou**

![Título da imagem](public/img/database.png)

---

8. Acesse o **_http://localhost:8000/_**

---

8.1 Crie as tabelas 
![Título da imagem](public/img/crieTable.png)

---

9. Crie seu usuario e realize o login 
![Título da imagem](public/img/login.png)

---

10. Na home verá os seguintes módulos:
![Título da imagem](public/img/tela-principal.png)

---
11. No Buscar Filmes encontrará a seguinte tela:
![Título da imagem](public/img/Busca-Filme-Genero.png)

---

12. No CRUD User encontrará a seguinte tela com todas as funções (Inserir / Editar / Visualizar / Excluir):
![Título da imagem](public/img/crud.png)

---
