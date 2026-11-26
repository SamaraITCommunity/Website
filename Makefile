.DEFAULT_GOAL := help

COMPOSE ?= docker compose
ARGS ?=

.PHONY: help init build install up down restart ps logs shell composer yii test site-build migrate

help: ## Показать доступные команды
	@awk 'BEGIN {FS = ":.*## "} /^[a-zA-Z_-]+:.*## / {printf "  %-12s %s\n", $$1, $$2}' $(MAKEFILE_LIST)

init: ## Создать .env, собрать образы, установить зависимости и запустить проект
	@test -f .env || cp .env.example .env
	$(COMPOSE) build
	$(COMPOSE) run --rm app composer install
	$(MAKE) site-build
	$(COMPOSE) up -d

build: ## Собрать образы
	$(COMPOSE) build

install: ## Установить зависимости Composer
	$(COMPOSE) run --rm app composer install

up: ## Запустить контейнеры в фоне
	$(COMPOSE) up -d

down: ## Остановить и удалить контейнеры (данные сохраняются)
	$(COMPOSE) down

restart: ## Перезапустить контейнеры
	$(COMPOSE) restart

ps: ## Показать состояние контейнеров
	$(COMPOSE) ps

logs: ## Следить за логами; ARGS="app nginx" — выбрать сервисы
	$(COMPOSE) logs -f $(ARGS)

shell: ## Открыть shell в контейнере приложения
	$(COMPOSE) exec app sh

composer: ## Выполнить Composer; например, make composer ARGS="show"
	$(COMPOSE) run --rm app composer $(ARGS)

yii: ## Выполнить команду Yii; например, make yii ARGS="--help"
	$(COMPOSE) exec app php yii $(ARGS)

test: ## Запустить тесты Codeception; ARGS позволяет выбрать набор
	$(COMPOSE) run --rm app vendor/bin/codecept run $(ARGS)

site-build: ## Собрать статические страницы YiiPress в output/
	@mkdir -p output
	$(COMPOSE) run --rm --no-deps --user "$$(id -u):$$(id -g)" yiipress build --workers=1 --no-cache $(ARGS)

migrate: ## Применить миграции учётных записей и профилей
	$(COMPOSE) exec app php yii identity:migrate
	$(COMPOSE) exec app php yii profile:migrate
