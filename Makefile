MAKEFLAGS += --silent

include ./.env
export ENV_FILE = ./.env
export UID=$(shell id -u)
export GID=$(shell id -g)
export USER_NAME=$(shell id -un)
export DOCKER_COMPOSE = docker-compose -f ./docker-compose.yml

.PHONY: *
SHELL=/bin/bash -o pipefail

COLOR="\033[32m%-18s\033[0m %s\n"

.PHONY: help
help: ## Show this help
	@printf "\033[33m%s:\033[0m\n" 'Available commands'
	@awk 'BEGIN {FS = ":.*?## "} /^[a-zA-Z0-9_-]+:.*?## / {printf "  "${COLOR}, $$1, $$2}' ${MAKEFILE_LIST}

.PHONY: init
init: ## Start containers
	@${MAKE} stop
	@${MAKE} docker_compose_up
	docker exec -ti ${SYSTEM_NAME_APP} composer install
	@${MAKE} info

.PHONY: docker_compose_up
docker_compose_up:
	docker-compose up -d --remove-orphans

.PHONY: info
info:
	@printf "\n\n";
	@printf ${COLOR} "⠿Application available at http://${APP_DOMAIN}";

.PHONY: stop
stop: ## Stop containers
	docker-compose down -v --remove-orphans

.PHONY: shell sh
sh: shell
shell: ## Start shell into backend container
	@printf ${COLOR} 'Login to backend container';
	docker exec -ti ${SYSTEM_NAME_APP} bash

# Global
.DEFAULT_GOAL := help
