# BACK-END

<br />

## Setting up a development environment

* create a file named .env (copy .env.example file) which should contain the following default setup ( you should provide your own values to this variables ):
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=MY_DB_MANE
DB_USERNAME=MY_DB_USER
DB_PASSWORD=MY_DB_PASSWORD

JWT_SECRET=RuoxLtY4F3HvH3K0aVTkgLPTZu8IvlhJ
```

## Running the app on DOCKER

* create a file named docker-compose.yml (copy docker-compose.yml.example file) which should contain the following default setup ( you should provide your own values to this variables ):
* Exec `docker-compose up -d` to create containers
* inside the application container
* Exec `composer install` This cmd witll install all required dependencies
* Exec `php artisan storage:link` create the symbolic link
* Exec `php artisan key:generate` to trigger laravel setup
* Exec `php artisan migrate:fresh --seed` to create tables and seed with data
* Exec `php artisan movies:import` Inserting data in the movies table

## Running the app

* Go in the `public` directory 
* Exec `php -S localhost:3000` to start the server
* Exec `composer install` This cmd witll install all required dependencies
* Exec `php artisan storage:link` create the symbolic link
* Exec `php artisan key:generate` to trigger laravel setup
* Exec `php artisan migrate:fresh --seed` to create tables and seed with data
* Exec `php artisan movies:import` Inserting data in the movies table

## Access the application on POSTMAN

* Login route: /api/users/login [post: email, password],
* Demo credentials email: admin@admin.com, password: admin

Test with POSTMAN first.

Headers ```Content-Type: application/json```

Body/raw data: 
```
{
	"user": {
		"email": "admin@admin.com",
		"password": "admin"
	}
}
```

## API's

* Register - Route: /api/users/register [POST],
* Login - Route: /api/users/login [POST],
* Movies - Route: /api/movies [GET],
* Add Favorites - Route: /api/favorites/store [POST],
* Delete Favorites - Route: /api/favorites/destroy/{$id} [DELETE],
