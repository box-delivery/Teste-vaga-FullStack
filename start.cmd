call docker-compose up -d
call docker-compose exec laravel.test composer install
call docker-compose exec laravel.test php artisan migrate --seed
