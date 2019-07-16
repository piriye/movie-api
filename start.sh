#!/usr/bin/env bash

docker-compose up -d
docker exec -it movie_app composer install
docker exec -it movie_app php artisan migrate
docker exec -it movie_app php artisan movies:fetch
