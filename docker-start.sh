#!/bin/sh

# Ensure Laravel clear are up-to-date
php artisan config:clear
php artisan route:clear
php artisan cache:clear
php artisan config:cache

# Create symbolic link for public storage access
php artisan storage:link

# Run database migrations if needed
php artisan migrate:refresh --force

#add initial db
php artisan db:seed --force

# Start PHP-FPM in the background
php-fpm & 

# Start Nginx in the background
nginx &

# Start Laravel queue worker in the foreground (keeps container running)
php artisan queue:work --sleep=3 --tries=3 &

# Start Laravel Reverb (WebSocket server)
php artisan reverb:start --host=0.0.0.0 --port=6001

# Prevent container from exiting
tail -f /dev/null