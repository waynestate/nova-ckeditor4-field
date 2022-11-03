## From v1.1.4 to v1.2.0

Added support for Laravel loadMigrationsFrom to allow for migrations to be handled without needing to publish them.

Previous versions the migration was being published with the timestamp of the time of publishing which caused multiple migrations to be published.

This update renames the migration that is published to include the timestamp from the time it was initially committed to prevent multiple migrations from being published.

You'll also want to make sure that your published `/config/nova/ckeditor-field.php` has the new `enable_migrations` and `auto_migrate` options.
```php
    'migrations' => [
        'enable_migrations' => true,
        'auto_migrate' => true,
    ],
```

It is possible that you could have multiple migrations if you have previously published the migrations. 
If this is the case, you will need to manually delete the migrations that were published before this update and republish the migrations.
```php
php artisan vendor:publish --tag=nova-ckeditor4-field-migrations
```
