set -e

echo "Deploying Aplication Development ..."

# install package
composer install

# enter maintenance mode
php artisan down

# update codebase
git pull origin development

php artisan migrate:fresh --seed

php artisan optimize:clear

# exit maintenance mode
php artisan up

echo "Application Deployed Successfully - Development"
