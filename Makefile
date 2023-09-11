#!/usr/bin/make

run-project:
	cp .env.example .env
	docker run --rm -v $(PWD):/opt -w /opt laravelsail/php82-composer:latest composer install
	vendor/bin/sail up -d

run-tests:
	docker-compose exec laravel.test php artisan test
