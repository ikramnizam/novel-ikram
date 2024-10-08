
PROJECT SETUP INSTRUCTION

1. git clone
2. composer install
3. npm install
4. npm run build
5. cp .env.example .env
6. update your .env file with your database credentials

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database_name
DB_USERNAME=your_username
DB_PASSWORD=your_password

7. php artisan key:generate
8. php artisan migrate
9. php artisan serve




PROJECT GUIDE

1. once project deployed, you need to register first and make sure the password you create is unique which mean you need to have 
-min 8 characters,
-have at least one letter
-have one uppercase and lowercase letter
-have atleast one number
-have atleast one symbol

2. then you will get link email verification. 
   to find link:
  -go to the storage/logs/laravel.log

3. click the link provided at laravel.log based on email provided while registering process
4. then you will be redirected at the main page of project.
5. create atleast 4 novel to see pagination


TESTING
1. create testing databse
2. run php artisan test


DECISION MADE DURING DEVELOPMENT

1. User passwords need to be secure and meet industry-standard complexity requirements.    Implemented password validation rules
2. Users must verify their email before they can access full application functionality.
3. Used Laravel's validation rules and custom validation logic to enforce strict input validation across forms, particularly for user registration, login, and profile updates.
5. Laravel’s auth middleware is used to protect routes such as novels.index and profile update pages. Only logged-in users can access these areas.