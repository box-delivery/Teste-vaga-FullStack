## Box Delivery application


The application consists of develop a favorite movies API so people can make a list of the movies they like best..
    
Dependencies
-------------
* [Git](https://git-scm.com/book/en/v2/Getting-Started-Installing-Git)
* [Laravel 8.x](https://laravel.com/)
* [PHP 7.4](https://www.php.net/releases/7_4_0.php)
* [Docker](https://docs.docker.com/)
* [Docker-compose](https://docs.docker.com/compose/)
* [The Movie DB](https://www.themoviedb.org/?language=pt-BR)


Installation
-------------

- After the clone of the project, cp .env.example to new archive .env into .env put your key for MOVIE_API_TOKEN and execute script in the root.
```console
./up.sh
```
Listing active containers.
```console
docker ps
```

Accessing the container terminal.

```console
docker exec -it CONTAINER_ID sh
```

Commands to be executed in the API container.

- Database creation.
```console
php artisan migrate --seed
```

- Database update
````console
php artisan migrate:fresh --seed
````

- Import movie list
````console
php artisan import:movie --limit 50
````

- Project url: [localhost:3001](http://localhost:3001)

-------------

Api endpoints
-------------
 
 | Method   | Path                | Public | 
 |--------- |---------------------| ------ |
 | POST     | /api/auth/login     |   X    |
 | POST     | /api/users          |   X    |
 | GET      | /api/bookmarks      |        |
 | POST     | /api/bookmarks      |        |
 | DELETE   | /api/bookmarks/{id} |        |
 | GET      | /api/movies         |        |
 

-------------

Route collection
-------------
Provided by [postman](https://www.postman.com/)

[collection-boxdelivery-douglas-salomao](https://documenter.getpostman.com/view/10450976/TVmLAdA5)

Note: the sample payload is available in the collection

Douglas Salomão Leite, douglassleite@outlook.com