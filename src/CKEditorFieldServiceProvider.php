<?php

namespace Waynestate\Nova;

use Illuminate\Support\Facades\Route;
use Laravel\Nova\Nova;
use Laravel\Nova\Events\ServingNova;
use Illuminate\Support\ServiceProvider;

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

        Nova::serving(function (ServingNova $event) {
            Nova::script('ckeditor', config('nova.ckeditor-field.ckeditor_url', 'https://cdn.ckeditor.com/4.19.0/full-all/ckeditor.js'));

            Nova::script('nova-ckeditor', __DIR__ . '/../dist/js/field.js');
            // Nova::style('nova-ckeditor', __DIR__ . '/../dist/css/field.css');
        });

        $this->publishes([
            __DIR__ . '/../config/ckeditor-field.php' => config_path('nova/ckeditor-field.php'),
        ], 'config');
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
            ->prefix('nova-vendor/ckeditor4-field')
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
