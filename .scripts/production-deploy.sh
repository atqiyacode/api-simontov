set -e

echo "Deploying Application for Production ..."

# enter maintenance mode
php artisan down

# update codebase
git pull origin production

# install package
composer install --optimize-autoloader

php artisan migrate:fresh --seed --force

php artisan optimize:clear

# exit maintenance mode
php artisan up


echo "Application Deployed Successfully - Production"
