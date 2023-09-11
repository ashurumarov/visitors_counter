#!/bin/bash

function sail-up {
	docker run --rm -v $(PWD):/opt -w /opt laravelsail/php82-composer:latest composer install
    vendor/bin/sail up -d
}

function run-project {
    cp .env.example .env
    sail-up
}

${1}
