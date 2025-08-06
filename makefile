.PHONY: up init sql down

DB_CONTAINER=db-1
DB_NAME=cgrd
DB_USER=root
DB_PASS=root
DB_HOST=127.0.0.1
DB_PORT=3307
SQL_FILE=./src/database/setup.sql

# Dynamically gets the db container name from docker-compose
DB_CONTAINER=$(shell docker-compose ps -q db)

up:
	docker-compose up -d --build
	@echo "Waiting for MySQL to be ready..."

	@until docker-compose exec db mysqladmin ping -h"127.0.0.1" --silent; do \
		printf "."; \
		sleep 1; \
	done

	@echo "\nMySQL is ready!"

init: up sql

sql:
	@echo "Running SQL initialization..."
	cat $(SQL_FILE) | docker exec -i $(DB_CONTAINER) \
		mysql -u$(DB_USER) -p$(DB_PASS) $(DB_NAME)
	@echo "SQL script executed."

down:
	docker-compose down
