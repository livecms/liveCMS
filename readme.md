# Project LiveCMS

##For Laravel 5.2, please checkout branch V0

## How To Install :

1. Create Composer Project
    ````
         composer create-project livecms/livecms --prefer-dist
    ````

2. Edit .env in folder **livecms**
    Fill with your database settings, example :
    ````    
        DB_HOST=127.0.0.1
        DB_DATABASE=livecms
        DB_USERNAME=root
        DB_PASSWORD=secret
    ````

3. Do Migrate
    ````
        cd livecms 
        php artisan migrate --seed
    ````
4. Run server or use php artisan server
    ````
         cd livecms 
         php artisan serve
    ````

5. Open your browser
    If you use artisan server, go to :
    ````
        http://localhost:8000
    ````

6. Login
    visit : http://yourdomain/login

    default username / password 
    
    1. Admin :
        email : admin@livecms.dev
        password : admin

    2. Super Admin :
        email : super@livecms.dev
        password : admin


## More Information
Email : mokh@rofiudin.com

## License

The LiveCMS is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT).
