<?php

namespace Waynestate\Nova\CKEditor4Field;

use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Route;
use Laravel\Nova\Nova;
use Laravel\Nova\Events\ServingNova;
use Illuminate\Support\ServiceProvider;

class CKEditor4FieldServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->booted(function () {
            $this->routes();
        });

        Nova::serving(function (ServingNova $event) {
            Nova::script('ckeditor', config('nova.ckeditor-field.ckeditor_url', 'https://cdn.ckeditor.com/4.19.1/full-all/ckeditor.js'));

            Nova::script('nova-ckeditor', __DIR__ . '/../dist/js/field.js');
            // Nova::style('nova-ckeditor', __DIR__ . '/../dist/css/field.css');
        });

        $this->publishes([
            __DIR__ . '/../config/ckeditor-field.php' => config_path('nova/ckeditor-field.php'),
        ], 'nova-ckeditor4-field-config');

        if(config('nova.ckeditor-field.migrations.auto_migrate', true)) {
            $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');
        }else{
            $this->publishes([
                __DIR__ . '/../database/migrations' => database_path('migrations'),
            ], 'nova-ckeditor4-field-migrations');
        }
    }

    /**
     * Register the field's routes.
     *
     * @return void
     */
    protected function routes()
    {
        if ($this->app->routesAreCached()) {
            return;
        }

        Route::middleware(['nova'])
            ->prefix('nova-vendor/nova-ckeditor4')
            ->group(__DIR__.'/../routes/api.php');
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
