# Laravel Auth

Install Laravel

```bash
# command you use to install laravel
```

Install Breeze

```bash

composer require laravel/breeze --dev
php artisan breeze:install
```

 ┌ Which Breeze stack would you like to install? ───────────────┐
 │ Blade with Alpine                                            │
 └──────────────────────────────────────────────────────────────┘

 ┌ Would you like dark mode support? ───────────────────────────┐
 │ No                                                           │
 └──────────────────────────────────────────────────────────────┘

 ┌ Which testing framework do you prefer? ──────────────────────┐
 │ Pest
 └──────────────────────────────────────────────────────────────┘

## Install laravel preset package

```bash

 
 
composer require pacificdev/laravel_9_preset
# Esegui comando preset
php artisan preset:ui bootstrap --auth
npm i

```

Update the vite config file

```bash
mv vite.config.js vite.config.cjs

php artisan serve
npm run dev
```

⚡ Ricorda di committare e pushare regolarmente!

## Refactoring Admin dashboard

create a controller to handle the dashboard requests

```bash
php artisan make:controller Admin/DashboardController

```

update the route and use the above controller

```php
Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');
```

retun the view in the index method in the dashboard controller

```php
class DashboardController extends Controller
{
    function index()
    {
        return view('dashboard');
    }
}

```
