## Employee App

The following web application was built using, Laravel, Vue and MySQL


### Instructions to Run The Application

1.Clone the repository: git clone https://github.com/Priom7/Laravel-Vue-MySQL-Task.git

2. Change Diroctory into App: cd employee-app

3. Setup .env file: 

            DB_CONNECTION=mysql
            DB_HOST=mysql
            DB_PORT=3306
            DB_DATABASE=employeeDB
            DB_USERNAME=sail
            DB_PASSWORD=password

4. Create Alias for sail command: alias sail='[ -f sail ] && sh sail || sh vendor/bin/sail'

3. Run Docker Container: sail up

4. Get into Container directory: docker exec -it employee-app-laravel.test-1 /bin/bash

5. Install dependecies for vue JS: npm install

6. Migrate and Seed Database:  php artisan migrate:refresh —seed

7.Run Dev for Frontend: Npm run dev

8. Exit Container: Exit
9. Stop Container: sail down




