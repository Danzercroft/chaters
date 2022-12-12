composer update 
php artisan key:generate
php artisan storage:link  
php artisan migrate:fresh --seed 
php artisan passport:install 
php artisan config:clear 
chmod 777 -R storage/
php-fpm -D
php artisan websockets:serve  --host 0.0.0.0 
#php artisan serve --port=9001 --host 0.0.0.0 & 
