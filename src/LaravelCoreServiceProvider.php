<?php

namespace DevPlace\LaravelCore;

use DevPlace\LaravelCore\Commands\ControllerGenerator;
use DevPlace\LaravelCore\Commands\CrudGenerator;
use DevPlace\LaravelCore\Commands\PolicyGenerator;
use DevPlace\LaravelCore\Commands\RequestGenerator;
use DevPlace\LaravelCore\Commands\RouteGenerator;
use DevPlace\LaravelCore\Commands\ServiceGenerator;
use DevPlace\LaravelCore\Commands\ViewGenerator;
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
        $this->loadViewsFrom(__DIR__ . '/resources/views', 'devplace');

        // translation
        $this->loadJsonTranslationsFrom(__DIR__ . '/resources/lang');

        // publishes
        $this->publishes([
            __DIR__ . '/resources/views' => resource_path('views/vendor/devplace'),
        ], 'devplace-views');

        // translations
        $this->publishes([
            __DIR__.'/resources/lang' => resource_path('lang/vendor/devplace'),
        ], 'devplace-lang');

        $this->publishes([
            __DIR__.'/resources/public' => public_path('vendor/devplace'),
        ], 'devplace-public');

        $this->publishes([
            __DIR__.'/resources/assets' => resource_path('assets/vendor/devplace'),
        ], 'devplace-assets');
    }
}
