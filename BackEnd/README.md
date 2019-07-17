# Task-Manager Backend

## Installation:
    In order to use this application you need to generate security keys and build assets using yarn, instruction is given below:

### Generate security keys:
    $ mkdir config/jwt
    $ openssl genrsa -out config/jwt/private.pem -aes256 4096
    $ openssl rsa -pubout -in config/jwt/private.pem -out config/jwt/public.pem
    
### Create Example User:
    bin/console app:create-example-account

### Build application:
    docker-compose build

### Run application:
    docker-compose up 

### Run/compile yarn:
    "docker-compose exec php-fpm bash" - open php-fpm container 
    "yarn dev" to build assets
    "yarn dev --watch" to keep on watching and building assets

## Useful development commands:

### Generate Fixtures:  
    bin/console app:load-fixtures
        
### Run composer:
    docker-compose run composer install

### Run tests
    ./vendor/bin/phpunit
    vendor/bin/phpunit tests --coverage-html ./ --whitelist=tests
    
### Run code sniffer
    ./vendor/bin/phpcs

### Code Sniffer:
    phpmd {dir to sniff} {output format} {config} --reportfile {where to save report}
    vendor/bin/phpmd src/ xml phpmd.xml --reportfile messDetectorResultReport.xml
    
### Copy paste detector
    phpcpd  --fuzzy src/

### PHP Stan
    vendor/bin/phpstan analyse src tests --level {0-7}
