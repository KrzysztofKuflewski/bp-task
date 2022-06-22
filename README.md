<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

## App Setup

After git clone:

- copy <i>.env.example</i> file and name as <i>.env</i> (root directory)
- create local mysql database (e.g. bp_task)
- complete <i>.env</i> file with db name and mysql server data
- run command <b>'composer install'</b> (in project directory)
- run command <b>'php artisan key:generate'</b> (in project directory)
- run command <b>'php artisan migrate --seed'</b> (in project directory)
- run command <b>'php artisan serve'</b> (in project directory) or create virtual host 

<b>Notice:</b>
<br>
<i>DatabaseSeeder.php</i> file contains credentials of the only that user that can log into the "admin panel".
