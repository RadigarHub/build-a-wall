build:
	UID=${shell id -u} GID=${shell id -g} docker compose build

down:
	UID=${shell id -u} GID=${shell id -g} docker compose down
