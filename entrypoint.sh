#!/usr/bin/env sh

composer install --no-interaction --prefer-dist --optimize-autoloader --ignore-platform-reqs
# cp .env.docker .env
# sed -i -e 's/DB_HOST=127.0.0.1/DB_HOST=db/g' .env
# sed -i -e 's/DB_USERNAME=/DB_USERNAME=root/g' .env
# sed -i -e 's/DB_PASSWORD=/DB_PASSWORD=root/g' .env
# sed -i -e 's/DB_DATABASE=/DB_DATABASE=api_hris/g' .env
chown -R $USER:www-data storage
chown -R $USER:www-data bootstrap/cache
chmod -R 775 .
chmod -R 775 storage
chmod -R 775 bootstrap/cache
# php artisan key:generate
# sleep 5s
# php artisan migrate:fresh --seed --force
# sleep 15s

# Add the following lines to set up cron for Laravel scheduler
echo "* * * * * cd /var/www/html && php artisan schedule:run >> /dev/null 2>&1" > /etc/cron.d/laravel-scheduler
chmod 0644 /etc/cron.d/laravel-scheduler
crontab /etc/cron.d/laravel-scheduler


php artisan octane:start --host=0.0.0.0 &
php artisan websocket:serve --host=0.0.0.0 --port=6001 &
php artisan queue:work --tries=3 --timeout=300 --sleep=1 --daemon &
php artisan mqtt:subscribe &
exec "$@"

