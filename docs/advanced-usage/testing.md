---
title: Testing
weight: 1
---

## Clear Cache During Tests

In your application's tests, if you are not seeding roles and permissions as part of your test `setUp()` then you may run into a chicken/egg situation where roles and permissions aren't registered with the gate (because your tests create them after that gate registration is done). Working around this is simple: 

In your tests simply add a `setUp()` instruction to re-register the permissions, like this:

```php
    public function setUp(): void
    {
        // first include all the normal setUp operations
        parent::setUp();

        // now re-register all the roles and permissions (clears cache and reloads relations)
        $this->app->make(\Bfe\Permission\PermissionRegistrar::class)->registerPermissions();
    }
```

If you are using Laravel's `LazilyRefreshDatabase` trait, you most likely want to avoid seeding permissions before every test, because that would negate the use of the `LazilyRefreshDatabase` trait. To overcome this, you should wrap your seeder in an event listener for the `MigrationsEnded` event:

```php
Event::listen(MigrationsEnded::class, function () {
    $this->artisan('db:seed', ['--class' => RoleAndPermissionSeeder::class]);
    $this->app->make(\Bfe\Permission\PermissionRegistrar::class)->forgetCachedPermissions();
});
```

Note that we call `PermissionRegistrar::forgetCachedPermissions` after seeding. This is to prevent a caching issue that can occur when the database is set up after permissions have already been registered and cached. 

## Factories

Many applications do not require using factories to create fake roles/permissions for testing, because they use a Seeder to create specific roles and permissions that the application uses; thus tests are performed using the declared roles and permissions.

However, if your application allows users to define their own roles and permissions you may wish to use Model Factories to generate roles and permissions as part of your test suite.

With Laravel 7 you can simply create a model factory using the artisan command, and then call the `factory()` helper function to invoke it as needed.

With Laravel 8 if you want to use the class-based Model Factory features you will need to `extend` this package's `Role` and/or `Permission` model into your app's namespace, add the `HasFactory` trait to it, and define a model factory for it. Then you can use that factory in your seeders like any other factory related to your app's models.

