<p align="center"><img src="https://laravel.com/assets/img/components/logo-laravel.svg"></p>

## About

Simple activities crud and validation using Laravel 5.6, Vuejs 2 and Bootstrap4.

## Install

``` bash
git clone https://github.com/rogerfernandezv/simple_activities_list
cd simple_activities_list
cp .env.example .env
composer install
npm install
```

## Config

Edit you .env with mysql host, username, password and database name.

```
php artisan migrate
php artisan db:seed
```

## Usage

```
php artisan serve
```

And you can go to http://localhost:8000

## Obs

The page is a vue component: resources/assets/js/components/Atividades.vue
