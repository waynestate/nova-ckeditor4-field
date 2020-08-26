<?php

namespace Waynestate\Nova;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Laravel\Nova\Events\ServingNova;
use Laravel\Nova\Nova;

class CKEditorFieldServiceProvider extends ServiceProvider
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

        $this->loadMigrationsFrom(__DIR__ . '/migrations/2020_07_17_214240_add_trix_table');

        Nova::serving(function (ServingNova $event) {
            Nova::script('ckeditor',
                config('nova.ckeditor-field.ckeditor_url', 'https://cdn.ckeditor.com/4.14.0/full-all/ckeditor.js'));

            Nova::script('nova-ckeditor', __DIR__ . '/../dist/js/field.js');
        });

        $this->publishes([
            __DIR__ . '/../config/ckeditor-field.php' => config_path('nova/ckeditor-field.php'),
        ], 'config');
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

    /**
     * Register the tool's routes.
     *
     * @return void
     */
    protected function routes()
    {
        if ($this->app->routesAreCached()) {
            return;
        }

        Route::middleware(['nova'])
             ->prefix('nova-vendor/nova-ckeditor4-field')
             ->namespace('Waynestate\Nova\Http\Controllers')
             ->group(__DIR__ . '/../routes/api.php');
    }
}
