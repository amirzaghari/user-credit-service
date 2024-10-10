# Build and run the Docker container
build:
	docker-compose up -d --build

# Start the Docker container
start:
	docker-compose up -d

# Stop the Docker container
stop:
	docker-compose down

# Open a shell in the running Docker container
shell:
	docker exec -it $(shell docker-compose ps -q php) sh

# Run PHPUnit tests inside Docker
test:
	docker exec -it $(shell docker-compose ps -q php) ./vendor/bin/phpunit tests

# Add a transaction via the CLI inside Docker
# Usage: make docker-add-transaction userId=<USER_ID> amount=<AMOUNT> date=<DATE>
add-transaction:
	docker exec -it $(shell docker-compose ps -q php) php command.php add-transaction $(userId) $(amount) $(date)

# List all users via the CLI inside Docker
list-users:
	docker exec -it $(shell docker-compose ps -q php) php command.php list-users
