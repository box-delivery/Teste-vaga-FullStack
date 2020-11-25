
## Configure

### Database
- **Version:** MySQL 5.7
- **Name:** delivery_test
- **File:** ./database/delivery_test.sql
- **Laravel Migration:** true
---
### Back-end
- **Host:** testephp.laravel
- **Doc File:** ./docs/Delivery Test.postman_collection.json (Postman Collection v2.1)
- **Doc Url:** https://documenter.getpostman.com/view/8724744/TVmFm1qN
---
### Unit Test
- Unit tests are on Postman, along with routes and documentation (Tests Tab)
---
### Install & Requeriments
#### Requeriments
- Laravel 8.x Server Requeriments https://laravel.com/docs/8.x/installation
- PHP 7.3 >=
- MySQL 5.7 >=
- Composer && php artisan installed
#### Install
- Clone this repository on a clean folder: https://github.com/matmper/test-laravel-movie
- Use "composer install" on repository folder
- Copy ".env.example" file and rename to ".env"
- Configure your database on ".env" file (./.env)
- Open your terminal and execute the migration: php artisan migrate
- Configure your Movie DB API Key (v3) in ".env" file
-- Alternative: import database file in your MySQL database (table movies is populated)
---
#### First Steps
- Use register route [PUT] /users to create a new user
- Use login route [POST] /users to login yourself and create your bearer token
- In postman, your bearer token will be a variable,  but you can send it manually in the header
- Use your system and be happy

![May the force be with us](https://media.tenor.com/images/1dc098da87dacc651a0738e2ef66c25f/tenor.gif)
May the force be with us!
