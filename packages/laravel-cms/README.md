# Laravel Content Management System

## Installation

You can install the package via composer:

```bash
composer require alkatechsoft/laravel-cms
php artisan queue:table
```

Migrate Database
``` php
php artisan migrate
```


Seed Database
``` php
for Windows:
php artisan db:seed --class=rifrocket\LaravelCms\Database\seeders\LbsSeeder

for Linux:
php artisan db:seed --class=rifrocket\\LaravelCms\\Database\\seeders\\LbsSeeder
```


Publish File
``` php
php artisan vendor:publish --tag=lbs:config --force   #config
php artisan vendor:publish --tag=lbs:assets --force   #assets
php artisan livewire:publish --assets
```

Changes In .env
``` php
register subdomain:  APP_DOMAIN= your_domain_name
chnage Queue Driver: QUEUE_CONNECTION=database  // Queue Worker is Required

```

In Your RouteServiceProvider add Domain
``` php
*app/Providers/RouteServieProvider

Route::domain(env('APP_DOMAIN'))->middleware('web')
        ->namespace($this->namespace)
        ->group(base_path('routes/web.php'));
```

In Your Authenticate Middleware
``` php
if (! $request->expectsJson()) {
            return route('lbs.auth.admin.login');
        }
```


### Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

### Security

If you discover any security related issues, please email developer.tech.dev@gmail.com instead of using the issue tracker.

## Credits

- [Mohammad Arif](https://github.com/alkatechsoft)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

## Laravel Package Boilerplate

This package was generated using the [Laravel Package Boilerplate](https://laravelpackageboilerplate.com).
