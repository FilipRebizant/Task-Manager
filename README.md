# Task-Manager

## Installation:
    Example account aren't provided yet.
    In order to use this application you need to generate security keys and build assets using yarn, instruction is given below:

### To generate security keys:
    $ mkdir config/jwt
    $ openssl genrsa -out config/jwt/private.pem -aes256 4096
    $ openssl rsa -pubout -in config/jwt/private.pem -out config/jwt/public.pem

### To build application:
    docker-compose build
    
### To run composer:
    docker-compose run composer install

### To run application:
    docker-compose up 

### To run tests open php-fpm container and run:
    ./vendor/bin/phpunit
    vendor/bin/phpunit tests --coverage-html ./ --whitelist=tests
    
### To run code sniffer open php-fpm container and run:
    ./vendor/bin/phpcs

### To run/compline yarn open php-fpm container and run:
    "yarn dev" to build assets
    "yarn dev --watch" to keep on watching and building assets
