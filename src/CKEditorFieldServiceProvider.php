<?php

namespace Waynestate\Nova;

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
        Nova::serving(function (ServingNova $event) {
            Nova::script('ckeditor', config('nova.ckeditor-field.ckeditor_url', 'https://cdn.ckeditor.com/4.11.3/full-all/ckeditor.js'));

            Nova::script('nova-ckeditor', __DIR__ . '/../dist/js/field.js');
            // Nova::style('nova-ckeditor', __DIR__ . '/../dist/css/field.css');
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
}
