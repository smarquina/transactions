# Transactions demo

This is a transactions demo backend & API. Made with the Laravel framework

### Installation
   
   This project is configured to be installed in a Docker container using Docker compose, or in the tradicional way
   over an standard PHP server.
    
   ##### Use Docker compose
   Requirements are specified in the `docker-compose.yml` file. Environment configurations are defined in Dockerfile.
   To install it follow next steps:
   
   1. Run `git clone https://github.com/smarquina/transactions.git tranactions`
   2. Make sure you have installed [Docker](https://docs.docker.com/). 
   Then, from the projects root folder run `docker-compose up` 
   3. Once container is installed and running, it can be accessed on `localhost:3000`
   
      #### Seed database:
      To [seed database](#seed-the-database), it is necessary to interact with compose CLI:
        1. Get the name of the container by running `docker-compose ps`
        2. Then, run seed command: `docker exec -it transactions_transactions-test_1 php artisan db:seed`
        
        ** To interact with transactions-test container as it where a normal php server, type: `docker exec -it [NAME] /bin/bash`
      
   ___
   ##### PHP server 
   To run it on your own server, you need to configure first dependencies, 
   environment variables and a MySQL or MariaDB.

1. Run `git clone https://github.com/smarquina/transactions.git tranactions`
2. Create a MySQL database for the project
    * ```mysql -u root -p```, if using Vagrant: ```mysql -u homestead -p secret```
    * ```create database transactions;```
    * ```\q```
3. From the projects root run `cp .env.example .env`
4. Configure your `.env` file
5. Dependencies are managed by composer. Make sure you
       have [Composer](https://getcomposer.org/) first. Then run `composer install` from the projects root folder
6. From the projects root folder run `sudo chmod -R 755 ../transactions`
7. From the projects root folder run `php artisan key:generate`
8. From the projects root folder run `php artisan jwt:secret`
9. From the projects root folder run `php artisan migrate`
10. From the projects root folder run `composer dump-autoload`

    ##### Seed the database:
    If you want to seed database with some random data, from the projects root folder run `php artisan db:seed`

    This also will create this seeded users
    
    |Name|Email|Password|
    |:------------|:------------|:------------|
    |Admin|admin@zenos.es|admin|

### Up and running

This project is divided into two parts **admin panel** and **rest api**:

   ##### Admin panel:
   To log into admin panel you can use seeded users o create new one by registering them.
   
   In admin panel there are available a list of users registered in app and a list of
   transactions made by users.
   
   Also is available a link to API docs.
   
   ##### API:
   Api docs are made with [Swagger](https://swagger.io/). Available under /api/documentation route.
   
   To make protected calls to api, you must first logged in. Api is secured by JWT auth tokens.
   This token must be included in the headers of the api call, adding:
   
    authorization: Bearer XXXXXX


### License

This demo is open-source software licensed under the [Apache License](https://opensource.org/licenses/Apache-2.0).
