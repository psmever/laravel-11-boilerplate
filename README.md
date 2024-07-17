<div align="center">

<div style="text-align: center;"><h4>📚 STACKS</h4></div>


<div style="text-align: center;">

<img src="https://img.shields.io/badge/php-525CBF?style=for-the-badge&logo=php&logoColor=black" alt="...">
<img src="https://img.shields.io/badge/laravel-525CBF?style=for-the-badge&logo=laravel&logoColor=black" alt="...">
<img src="https://img.shields.io/badge/docker-DEE0FA?style=for-the-badge&logo=docker&logoColor=black" alt="...">
<img src="https://img.shields.io/badge/mysql-1572B6?style=for-the-badge&logo=mysql&logoColor=black" alt="...">
</div>

<br />
<hr />

<h1 style="text-align: center;">Laravel 11 Boilerplate</h1>
</div>

## stack
```shell
> docker-compose
> docker
> laravel-ide-helper
> laravel passport 
```

## develop
```shell
# composer install

# npm install

# npm run build

# composer docker:build
# composer docker:start
# composer docker:shell
```

## env
```shell
APP_NAME=
APP_ENV=local
APP_KEY=
APP_DEBUG=true
APP_TIMEZONE="Asia/Seoul"
APP_URL=http://localhost:9000

APP_LOCALE=ko
APP_FALLBACK_LOCALE=en
APP_FAKER_LOCALE=en_US

APP_MAINTENANCE_DRIVER=file
# APP_MAINTENANCE_STORE=database

BCRYPT_ROUNDS=12

LOG_CHANNEL=stack
LOG_STACK=single
LOG_DEPRECATIONS_CHANNEL=null
LOG_LEVEL=debug

# DB_CONNECTION=sqlite
DB_CONNECTION=mariadb
DB_HOST=host.docker.internal
DB_PORT=3306
DB_DATABASE=
DB_USERNAME=
DB_PASSWORD=

SESSION_DRIVER=database
SESSION_LIFETIME=120
SESSION_ENCRYPT=false
SESSION_PATH=/
SESSION_DOMAIN=null

BROADCAST_CONNECTION=log
FILESYSTEM_DISK=local
QUEUE_CONNECTION=database

CACHE_STORE=database
CACHE_PREFIX=

MEMCACHED_HOST=127.0.0.1

REDIS_CLIENT=phpredis
REDIS_HOST=127.0.0.1
REDIS_PASSWORD=null
REDIS_PORT=6379

MAIL_MAILER=log
MAIL_HOST=127.0.0.1
MAIL_PORT=2525
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_ENCRYPTION=null
MAIL_FROM_ADDRESS="hello@example.com"
MAIL_FROM_NAME="${APP_NAME}"

AWS_ACCESS_KEY_ID=
AWS_SECRET_ACCESS_KEY=
AWS_DEFAULT_REGION=us-east-1
AWS_BUCKET=
AWS_USE_PATH_STYLE_ENDPOINT=false

VITE_APP_NAME="${APP_NAME}"
```

## phpstorm prettier

[prettier php github link](https://github.com/prettier/plugin-php).

> install

```bash
# yarn global add prettier @prettier/plugin-php
```

> phpstorm prettier

```bash
# ~/.config/yarn/global/node_modules/prettier
```

## License

[MIT](https://choosealicense.com/licenses/mit/)
