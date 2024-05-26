dev-down:
	docker compose down
dev-up:
	# check if .env file exists if not copy .env.dev.sample
	[ -f .env ] || cp .env.dev.sample .env
	docker-compose up -d
