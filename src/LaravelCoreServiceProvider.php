<?php

namespace Porum\LaravelCore;

use Porum\LaravelCore\Commands\ControllerGenerator;
use Porum\LaravelCore\Commands\CrudGenerator;
use Porum\LaravelCore\Commands\PolicyGenerator;
use Porum\LaravelCore\Commands\RequestGenerator;
use Porum\LaravelCore\Commands\RouteGenerator;
use Porum\LaravelCore\Commands\ServiceGenerator;
use Porum\LaravelCore\Commands\ViewGenerator;
use Illuminate\Support\ServiceProvider;

class LaravelCoreServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        // commands
        if ($this->app->runningInConsole()) {
            $this->commands([
                RequestGenerator::class,
                ServiceGenerator::class,
                PolicyGenerator::class,
                ControllerGenerator::class,
                ViewGenerator::class,
                RouteGenerator::class,
                CrudGenerator::class,
            ]);
        }

        // routes
        $this->loadRoutesFrom(__DIR__ . '/routes/admin.php');

        // views
        $this->loadViewsFrom(__DIR__ . '/resources/views', 'porum');

        // translation
        $this->loadJsonTranslationsFrom(__DIR__ . '/resources/lang');

        // publishes
        $this->publishes([
            __DIR__ . '/resources/views' => resource_path('views/vendor/porum'),
        ], 'porum-views');

        // translations
        $this->publishes([
            __DIR__.'/resources/lang' => resource_path('lang/vendor/porum'),
        ], 'porum-lang');

        $this->publishes([
            __DIR__.'/resources/public' => public_path('vendor/porum'),
        ], 'porum-public');

        $this->publishes([
            __DIR__.'/resources/assets' => resource_path('assets/vendor/porum'),
        ], 'porum-assets');
    }
}
