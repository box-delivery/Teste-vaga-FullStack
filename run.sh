#!/bin/bash

if [ -z "$MOVIE_DB_API_KEY" ]; then
    echo "Must set MOVIE_DB_API_KEY variable via export";
    exit 1;
fi;

if [ -z "$IMAGETAG" ]; then
    echo "Must set IMAGETAG env variable referring to docker build tag";
    exit 1;
fi;

container_id=$(docker run -it --detach -p 8000:8000 --env MOVIE_DB_API_KEY=$MOVIE_DB_API_KEY $IMAGETAG)
if [ $? -ne 0 ]; then
    echo "Could not start container - check logs";
    exit 1;
fi;

docker exec $container_id php artisan key:generate
docker exec $container_id php artisan jwt:secret --force
docker exec $container_id php artisan migrate:fresh
docker exec $container_id php artisan movies:fill 20
