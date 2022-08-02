#!/usr/bin/env bash
cd /app

cp .env.dist .env

composer install && cd .. && supervisord && echo "DONE!"
