#Client of the Task-Manager

## Vagrant
    vagrant up
    
### Build for development
    vagrant ssh
    cd /var/www/html/FrontEnd
    npm run parcel-dev
    
### Build for production
    vagrant ssh
    cd /var/www/html/FrontEnd
    npm run parcel-prod

## Docker
    docker-compose up

### Build for development
    docker-compose exec react bash
    npm run parcel-dev
    
### Build for production
    docker-compose exec react bash
    npm run parcel-prod