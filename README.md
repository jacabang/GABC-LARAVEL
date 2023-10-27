<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

# 👕 GABC Exam

I created a simple MVC-like framework to create the application on my own. It is composed of:

- Route Processing
- Controller
- Repository (Pattern)
- Model
- View (Client)


## ⚙️System Requirement

**Server:** Apache | NGINX, PHP 7, MySQL

## 🧩 JQuery Library Used

- [ Bootstrap 5.3 ](https://getbootstrap.com "Bootstrap 5.3")
- [ Select2 ](https://select2.org/ "Select2")
- [ DataTable ](https://datatables.net/ "Select2")
- [ Responsive-Tabs ](https://jellekralt.github.io/Responsive-Tabs "Responsive-Tabs")
- [ Font-Awesome 4.7 ](https://fontawesome.com/v4/icons/ "Font-Awesome 4.7")
- [ SweetAlert ](https://sweetalert.js.org/ "SweetAlert")


## 🛠 Skills
PHP, HTML, CSS, Vanila JS, JQuery


## 📌 Installation

- clone the folder project to your PHP server folder lookup.
Note: Note: In my case, I use [ XAMPP ](https://www.apachefriends.org/ "xampp"), so I just put the project in the ``` htdocs ``` or ``` www ``` if you are using [ WAMP ](https://www.apachefriends.org/ "wamp")

```
git clone https://github.com/jacabang/GABC-LARAVEL.git
```
- go to the generated project folder then run ``` composer update ```
- I currently use my local on creating this project and named my database ``` gabc ```, If you wish to change the database name, you may want to look into
- You may edit the ``` .env ``` file inside the generated folder
- if no ``` .env ``` you may copy and rename the ``` .env.example ``` or you may create a file with the content:

```
APP_NAME=Laravel
APP_ENV=local
APP_KEY=base64:/iPmu2Ynb89m9QynKrUPTTMYMv49eNyTV68tbNVHCEU=
APP_DEBUG=true
APP_URL=http://localhost

LOG_CHANNEL=stack
LOG_DEPRECATIONS_CHANNEL=null
LOG_LEVEL=debug

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=gabc
DB_USERNAME=root
DB_PASSWORD=

BROADCAST_DRIVER=log
CACHE_DRIVER=file
FILESYSTEM_DRIVER=local
QUEUE_CONNECTION=sync
SESSION_DRIVER=file
SESSION_LIFETIME=120

MEMCACHED_HOST=127.0.0.1

REDIS_HOST=127.0.0.1
REDIS_PASSWORD=null
REDIS_PORT=6379

MAIL_MAILER=smtp
MAIL_HOST=mailhog
MAIL_PORT=1025
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_ENCRYPTION=null
MAIL_FROM_ADDRESS=null
MAIL_FROM_NAME="${APP_NAME}"

AWS_ACCESS_KEY_ID=
AWS_SECRET_ACCESS_KEY=
AWS_DEFAULT_REGION=us-east-1
AWS_BUCKET=
AWS_USE_PATH_STYLE_ENDPOINT=false

PUSHER_APP_ID=
PUSHER_APP_KEY=
PUSHER_APP_SECRET=
PUSHER_APP_CLUSTER=mt1

MIX_PUSHER_APP_KEY="${PUSHER_APP_KEY}"
MIX_PUSHER_APP_CLUSTER="${PUSHER_APP_CLUSTER}"
```
- after you've create a new database and setup the database access on the ``` .env ``` file
- go to the project root folder, then run the migration
```
php artisan migrate
```
or
```
php artisan migrate:fresh
```
- migrate fresh will drop all create table and stored procedure on the data base and run a new
- Make sure that the folder ``` public/uploads ``` has a write permission.
- run the application on the cmd ``` php artisan serve ``` it will prompt a local host link e.g. (``` http://127.0.0.1:8000/ ```)
- on first run you may encounter an error like:

![App Screenshot](https://i.ibb.co/59pY3B7/396594332-1062469878097340-7420290328909237822-n.png)

- on the cmd, in project root folder just run the following lines:
```
php artisan key:generate
php artisan config:cache
```


## 🖼️ Screenshots

### Branch List

![App Screenshot](https://i.ibb.co/1qnkL8N/download.png)

### Branch Form

![App Screenshot](https://i.ibb.co/w6Kq0BG/download-1.png)

### Employee List


![App Screenshot](https://i.ibb.co/1002jjF/download-2.png)

### Employee Form


![App Screenshot](https://i.ibb.co/HT3yy6y/download-3.png)