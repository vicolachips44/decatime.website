# Website example based on SLIM 3 Framework

## starting up:

### The environment configuration file

The configuration variables relay on phpdotenv package.
you must create a *.env* file inside config folder and put lines located
in *.env.example*

### Initialisation of the project

+ composer install
+ bower install
+ npm install
+ grunt
+ go to config and cp .env.example to **.env**
+ mkdir -p cache/twig
+ mkdir -p cache/phpSession
+ run: **sh bin/initdb**
+ ./bin/runserv
+ navigate to **http://localhost:8000**

### Database building
If you don't change anything in .env configuration file then the default database is sqlite and is named: *dbsite.sdb3*.
To build it run command:

``` bash
./bin/initdb
```

This will actually:
+ Drop the database if exists
+ Create the schema
+ Update entities
+ load fixtures

> Fixtures are located in fixtures folder in the root folder.

