## Installation

Setup .env with your mysql credentials

```sh
composer install
bin/console doctrine:database:create
bin/console doctrine:schema:update --force
```

In .php-version is set PHP version for Symfony CLI

```sh
symfony serve
```