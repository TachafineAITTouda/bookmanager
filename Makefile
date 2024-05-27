dev-down:
	docker-compose down

dev-up:
	# check if .env file exists if not copy .env.dev.sample
	[ -f .env ] || cp .env.dev.sample .env
	docker compose up -d

laravel-test:
	docker compose exec laravel php artisan migrate --env=testing
	docker compose exec laravel php artisan test

laravel-shell:
	docker compose exec laravel bash

laravel-migrate:
	docker compose exec laravel php artisan migrate

laravel-seed:
	docker compose exec laravel php artisan db:seed

laravel-cache-clear:
	docker compose exec laravel php artisan cache:clear

prod-up:
	[ -f .env ] || cp .env.prod.sample .env
	docker compose -f docker-compose.prod.yml up -d

prod-down:
	docker compose -f docker-compose.prod.yml down
