#!bin/bash
docker compose exec phpunit bash -c "php artisan db:seed --class=RoleSeeder"
docker compose exec phpunit bash -c "php artisan create:user"
