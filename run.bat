
docker run -it --detach -p 8000:8000 --name apifilmes --env MOVIE_DB_API_KEY=%1 %2

docker exec apifilmes php artisan key:generate
docker exec apifilmes php artisan jwt:secret --force
docker exec apifilmes php artisan migrate:fresh
docker exec apifilmes php artisan movies:fill 20
