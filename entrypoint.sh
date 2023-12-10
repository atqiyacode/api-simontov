#!/usr/bin/env sh

composer install --no-interaction --prefer-dist --optimize-autoloader --ignore-platform-reqs
# cp .env.docker .env
# sed -i -e 's/DB_HOST=127.0.0.1/DB_HOST=db/g' .env
# sed -i -e 's/DB_USERNAME=/DB_USERNAME=root/g' .env
# sed -i -e 's/DB_PASSWORD=/DB_PASSWORD=root/g' .env
# sed -i -e 's/DB_DATABASE=/DB_DATABASE=api_hris/g' .env
chown -R $USER:www-data storage
chown -R $USER:www-data bootstrap/cache
chmod -R 777 .
chmod -R 777 storage
chmod -R 777 bootstrap/cache
php artisan key:generate
# sleep 5s
php artisan migrate:fresh --seed --force
# sleep 15s
php artisan octane:start --host=0.0.0.0 &
php artisan websocket:serve --port=6001 &
# php artisan generate:dummy-data &
php artisan mqtt:subscribe &
php artisan queue:work --tries=3 --timeout=300 --sleep=1 --daemon &
exec "$@"

