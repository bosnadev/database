[![Build Status](https://travis-ci.org/Bosnadev/Database.svg?branch=master)](https://travis-ci.org/Bosnadev/Database)


Laravel-Postgres-Extended
=========================

An extended PostgreSQL driver for Laravel 5 with support for some aditional PostgreSQL data types: hstore, uuid, geometric types (point, path, circle, line, polygon...)

## Getting Started  
### Laravel 5.2
1. Run `composer require bosnadev/database` in your project root directory.
2. Add `Bosnadev\Database\DatabaseServiceProvider::class` to `config/app.php`'s `providers` array.

Then you are done.

### Lumen 5.*
1. Run `composer require bosnadev/database` in your project root directory.
2. Add `$app->register(Bosnadev\Database\DatabaseServiceProvider::class);` to `bootstrap/app.php` (under the "Register Service Providers" section)
3. Uncomment the line `$app->withEloquent();` in `bootstrap/app.php`
