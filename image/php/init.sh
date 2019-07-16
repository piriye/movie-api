#!/usr/bin/env bash

php artisan migrate
php artisan movies:fetch
