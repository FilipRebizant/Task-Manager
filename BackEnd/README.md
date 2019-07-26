# Task-Manager Backend
    
### Create Example User:
    bin/console app:create-example-account

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
