# Contents

1. [Laravel](#laravel)
    - [Instalation Laravel](#installation-laravel)
2. [Filamentphp](#filamentphp)
    - [Instalation Filamentphp](#installation-filamentphp)
    - [Automatically Generating](#automatically-generating)

# Laravel

See more documentation of [here](https://laravel.com/docs/).

## Installation Laravel

Install larvel using composer:

```bash
composer create-project laravel/laravel example-app
```

[to top ☝️](#contents)

# Filamentphp

See more documentation of Filamentphp [here](https://filamentphp.com/docs/).

## Installation Filamentphp

Since Livewire v3 is still in beta, set the minimum-stability in your composer json to dev:

```bash
"minimum-stability": "dev",
```

Install the Filament Panel Builder:

```bash
composer require filament/filament:"^3.0-stable" -W

php artisan filament:install --panels
```

## Migrate

Run the migrate command:

```bash
php artisan migrate
```

## Create a user

Create a new user account with the following command:

```bash
php artisan make:filament-user
```

## Automatically generating forms and tables

Create resource:

```bash
php artisan make:filament-resource User --generate
```

Create resource with soft delete:

```bash
php artisan make:filament-resource User --generate --soft-deletes
```

Add view page for view dwtail data without modal:

```bash
php artisan make:filament-page ViewUser --resource=UserResource --type=ViewRecord
```

## Observer

Add observer for deleting file one storage:

```bash
php artisan make:observer UserObserver --model=User
```

Add function on file `app\Observer\UserObserver.php` on update:

```bash
public function updated(User $user): void
    {
        if ($user->isDirty('file')) {
            Storage::disk('public')->delete($user->getOriginal('file'));
        }
    }
```

On delete or softdelete:

```bash
public function forceDeleted(User $user): void
    {
        if (!is_null($user->file)) {
            Storage::disk('public')->delete($user->file);
        }
    }
```

[to top ☝️](#contents)
