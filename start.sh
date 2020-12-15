#!/bin/bash
./vendor/bin/sail up -d
./vendor/bin/sail composer install
./vendor/bin/sail artisan migrate --seed
