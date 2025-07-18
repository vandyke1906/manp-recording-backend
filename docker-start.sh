#!/bin/sh

# Ensure Laravel clear are up-to-date
php artisan config:clear
php artisan cache:clear
php artisan route:clear

# Create symbolic link for public storage access
php artisan storage:link

# Run database migrations if needed
php artisan migrate --force

#add initial db
php artisan db:seed

# Start PHP-FPM in the background
php-fpm & 

# Start Nginx in the background
nginx &

# Start Laravel queue worker in the foreground (keeps container running)
php artisan queue:work --sleep=3 --tries=3
php artisan reverb:start --port=6001 --sleep=5 --tries=5
