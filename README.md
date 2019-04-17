# Task-Manager

## Installation commands:

### To build application:
    docker-compose build
    
### To run composer:
    docker-compose run composer install

### To run application:
    docker-compose up 

### To run tests open php-fpm container and run:
    ./vendor/bin/phpunit
    
### To run code sniffer open php-fpm conntainer and run:
    ./vendor/bin/phpcs