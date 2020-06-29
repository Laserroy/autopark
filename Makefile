install:
	composer install
start:
	php artisan serve
test:
	php artisan test
logs:
	tail -f storage/logs/laravel.log
lint:
	composer run-script phpcs -- --standard=PSR2 ./app
