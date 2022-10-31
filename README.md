# Associate users with permissions and roles


## Documentation, Installation, and Usage Instructions

To get started with using the package, we'll install it using the following command:

```php

```
Now that we've installed the package, we'll need to publish the database migration and config file:

```php
php artisan vendor:publish --provider="Bfe\Permission\PermissionServiceProvider"
```
We can now run the migrations to create the new tables in our database:

```php
php artisan migrate
```
Assuming that we are using the default config values and haven't changed anything in the package's config/permission.php, we should now have five new tables in our database:


## What It Does
This package allows you to manage user permissions and roles in a database.

Once installed you can do stuff like this:

```php
// Adding permissions to a user
$user->givePermissionTo('edit articles');

// Adding permissions via a role
$user->assignRole('writer');

$role->givePermissionTo('edit articles');
```

Because all permissions will be registered on [Laravel's gate](https://laravel.com/docs/authorization), you can check if a user has a permission with Laravel's default `can` function:

```php
$user->can('edit articles');
```


### Testing

``` bash
composer test
```
