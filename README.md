# The Train System
### This is a test project created by [Stiff Roy](#) for a test.

## Installation

To run the project locally on your local server please clone the Git repository
```bash
git clone https://github.com/stiffroy/train-system.git
```

Then go to the folder
```bash
cd train-system
```

and install all the php packages by composer
```bash
composer install
```

Please note that you need minimum PHP 8.1 for using the project.

## Setup
Now setup the database
````bash
vi .env.local
````

and add the environment value for connecting to the database
```dotenv
DATABASE_URL="mysql://db_user:db_password@127.0.0.1:3306/db_name?serverVersion=mariadb-10.3.29&charset=utf8mb4"
```

Change the db_user, db_password and db_name according to your values.

Let us now make the database:
```bash
php bin/console doctrine:database:drop
php bin/console doctrine:database:create
php bin/console doctrine:migrations:migrate
```

## Enjoy

We are ready. Let us start a local PHP web server:
```bash
php -S localhost:8080 public/index.php
```

and open the localhost in our webserver at [localhost:8080](http://localhost:8080).

Thanks!!!