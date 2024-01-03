## Employee App

The following web application was built using, Laravel, Vue and MySQL

### Instructions to Run The Application with Docker

1.  Clone the repository:

            git clone https://github.com/Priom7/Laravel-Vue-MySQL-Task.git

2.  Change Diroctory into App:

            cd employee-app

3.  Setup .env file:

            DB_CONNECTION=mysql
            DB_HOST=mysql
            DB_PORT=3306
            DB_DATABASE=employeeDB
            DB_USERNAME=sail
            DB_PASSWORD=password

4.  Create Alias for sail command:

            alias sail='[ -f sail ] && sh sail || sh vendor/bin/sail'

5.  Run Docker Container:

            sail up -d

6.  Get into Container directory:

            docker exec -it employee-app-laravel.test-1 /bin/bash

7.  Install dependecies for vue JS:

            npm install

8.  Migrate and Seed Database:

            php artisan migrate:refresh —seed

9.  Run Dev for Frontend:

            npm run dev

10. Exit Container:

            exit

11. Stop Container:

            sail down
