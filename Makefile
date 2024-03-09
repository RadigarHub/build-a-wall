.DEFAULT_GOAL := help
.PHONY: bin/console

help:
	@echo "Available targets:"
	@echo "  deps                       -->  To build docker container and install dependencies. IT MUST BE RUN FIRST ONE TIME."
	@echo "  build-a-wall ARGS=\"\$$1 \$$2\"  -->  To run the command to build a wall with the given arguments being [\$$1 = Number of rows] and [\$$2 = Number of bricks per row]"
	@echo "  test/coverage              -->  To test the application with code coverage"

build:
	@UID=${shell id -u} GID=${shell id -g} docker compose build

down:
	@UID=${shell id -u} GID=${shell id -g} docker compose down

deps: build
	@UID=${shell id -u} GID=${shell id -g} docker compose run --user $(shell id -u):$(shell id -g) --rm build-a-wall bash -c "\
			composer install --prefer-dist --no-progress --no-scripts --no-interaction --optimize-autoloader 				 && \
			composer dump-autoload --classmap-authoritative 																 ;"

clean-cache:
	@rm -rf var
	@UID=${shell id -u} GID=${shell id -g} docker compose run --user $(shell id -u):$(shell id -g) build-a-wall bash -c "composer dump-autoload --classmap-authoritative"
	@UID=${shell id -u} GID=${shell id -g} docker compose run --user $(shell id -u):$(shell id -g) build-a-wall bash -c "bin/console cache:warmup"

bin/console:
	@UID=${shell id -u} GID=${shell id -g} docker compose run --user $(shell id -u):$(shell id -g) build-a-wall bash -c "bin/console"

test: test/unit test/application

test/unit:
	@UID=${shell id -u} GID=${shell id -g} docker compose run --user $(shell id -u):$(shell id -g) build-a-wall bash -c "bin/phpunit --order-by=random --testsuite Unit"

test/application:
	@UID=${shell id -u} GID=${shell id -g} docker compose run --user $(shell id -u):$(shell id -g) build-a-wall bash -c "bin/phpunit --order-by=random --testsuite Application"

test/coverage:
	@UID=${shell id -u} GID=${shell id -g} docker compose run --user $(shell id -u):$(shell id -g) build-a-wall bash -c "bin/phpunit --coverage-text --coverage-clover=coverage.xml --order-by=random"

build-a-wall:
	@UID=${shell id -u} GID=${shell id -g} docker compose run --user $(shell id -u):$(shell id -g) build-a-wall bash -c "bin/console wall:build $(ARGS)"
