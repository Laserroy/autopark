install:
	composer install
	npm install
setup: env-prepare sqlite-prepare install key db-prepare
start:
	php artisan serve
test:
	php artisan test
logs:
	tail -f storage/logs/laravel.log
lint:
	composer run-script phpcs -- --standard=PSR2 ./app
db-prepare:
	php artisan migrate --seed
config-clear:
	php artisan config:clear
env-prepare:
	cp -n .env.example .env || true
sqlite-prepare:
	touch database/database.sqlite
key:
	php artisan key:generate

