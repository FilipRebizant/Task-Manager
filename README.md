# Task-Manager

## Task Manager is divided to two web apps:

### Backend is playground for
   * Web API 
   * DDD
   * CQRS
    

### Frontend is written in React for better experience

## Installation:
    In order to use this application you need to generate security keys and build assets, instruction is given below:

### Generate security keys:
    mkdir BackEnd/config/jwt
    openssl genrsa -out BackEnd/config/jwt/private.pem -aes256 4096
    openssl rsa -pubout -in BackEnd/config/jwt/private.pem -out BackEnd/config/jwt/public.pem

### Build application:
    docker-compose build

### Run application:
    docker-compose up
    or
    vagrant up 

## Additional info about installation, tests and tools are included in sub-folders.