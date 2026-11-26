# SITC — SITC

Сайт локального IT-сообщества. Основа проекта — официальный веб-шаблон Yii 3, PHP-FPM, Nginx и PostgreSQL в Docker Compose.

## Запуск для разработки

Необходимы Docker с работающим сервером, Docker Compose и Make.

```sh
make init
```

Откройте http://localhost:8080. Порты и учётные данные локальной базы задаются в `.env`. PostgreSQL доступен на `localhost:5432`; из контейнера приложения — на `db:5432`. Данные хранятся в томе `postgres_data`. Настройки `DB_HOST`, `DB_PORT`, `DB_NAME`, `DB_USER`, `DB_PASSWORD` передаются контейнеру приложения; подключение базы к коду и миграции предстоит добавить при реализации первой функциональности.

```sh
make help                       # все команды
make up                         # запустить проект
make down                       # остановить контейнеры, сохранив данные
make logs ARGS="app nginx"      # логи выбранных сервисов
make shell                      # shell приложения
make yii ARGS="--help"          # команды Yii
make composer ARGS="show"       # команды Composer
make test                       # тесты Codeception
```

Конфигурация предназначена только для разработки: отладка включена, пароль базы тестовый. Профили, авторизация, задания и остальные функции пока не реализованы.

Шаблон приложения: [yiisoft/app](https://github.com/yiisoft/app), лицензия BSD-3-Clause; лицензия проекта — в файле LICENSE.
