# Teste-Desenvolvimento-MadeiraMadeira

---
## Subindo o Docker para rodar o app
1. **docker-compose build app**
2. **docker-compose up -d**
3. ![Título da imagem](rodar-docker.png)

---
## Instalar as dependências do composer
4. **docker-compose exec app composer install**
---

## crie uma chave para o artisan
5. **docker-compose exec app php artisan key:generate**

---

## Verifique o host do mysql que o Docker gerou

Comando no terminal:

6.0. **docker ps**

![Título da imagem](docker-ps.png)


6.1. **docker inspect _id do mysql_**

![Título da imagem](docker-inspect.png)

6.3. Copie o numero do IPAddress 
* Ex:  _172.29.0.4_
---

## Edit o host do mysql
7. **Abra o arquivo database.php linha 49 e coloque o host que o docker gerou**

![Título da imagem](database.png)

---

8. Acesse o **_http://localhost:8000/_**

---

9. Crie seu usuario e realize o login 
![Título da imagem](login.png)

---

10. Na home verá os seguintes módulos:
![Título da imagem](tela-principal.png)

---
11. No Buscar GitHub encontrará a seguinte tela:
![Título da imagem](Busca-Git-Nome.png)

---

12. No CRUD User encontrará a seguinte tela com todas as funções (Inserir / Editar / Visualizar / Excluir):
![Título da imagem](crud.png)

---
