dev-down:
	docker-compose down

dev-up:
	# check if .env file exists if not copy .env.dev.sample
	[ -f .env ] || cp .env.dev.sample .env
	docker-compose up -d

laravel-test:
	docker-compose exec laravel php artisan test
