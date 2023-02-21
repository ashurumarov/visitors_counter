#!/bin/bash

function sail-up {
    vendor/bin/sail up -d
}

function artisan-commands {
    php artisan key:generate
}

function run-project {
    cp .env.example .env
    sail-up
    artisan-commands
}

${1}
