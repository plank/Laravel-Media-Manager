<?php

namespace Plank\MediaManager;

use Illuminate\Contracts\Container\Container;
use Illuminate\Support\Facades\App;
use Illuminate\Support\ServiceProvider;
use Plank\MediaManager\Http\Controllers\MediaController;
use Plank\MediaManager\Http\Controllers\MediaManagerController;

class MediaManagerServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        /*
         * Optional methods to load your package assets
         */
        // $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'media-manager');
        // $this->loadViewsFrom(__DIR__.'/../resources/views', 'media-manager');
        // $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
        $this->loadRoutesFrom(__DIR__.'/../routes/web.php');

        if ($this->app->runningInConsole()) {
            $this->publishes([
                MANAGER_PATH.'/config/config.php' => config_path('media-manager.php'),
            ], 'config');

            $this->publishes([
                MANAGER_PATH.'/resources/js' => resource_path('assets/plank/laravel-media-manager')],
                'vue-components');

            $this->publishes([
                MANAGER_PATH.'/public' => public_path('vendor/laravel-media-manager'),
            ], 'manager-assets');


            // Registering package commands.
            // $this->commands([]);
        }
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        if (!defined('MANAGER_PATH')) {
            define('MANAGER_PATH', realpath(__DIR__.'/../'));
        }

        // Automatically apply the package configuration
        $this->mergeConfigFrom(__DIR__.'/../config/config.php', 'media-manager');

        // Register the main class to use with the facade
        $this->registerMediaManager();
        $this->registerMediaManagerController();
        $this->registerMediaController();
    }

    public function registerMediaManager()
    {
        $this->app->bind('media-manager', function (Container $app) {
            return new MediaManager;
        });
    }

    public function registerMediaManagerController()
    {
        $this->app->bind('MediaManagerController', function (Container $app) {
            return new MediaManagerController($app['media-manager']);
        });
    }

    public function registerMediaController()
    {
        $this->app->bind('MediaController', function (Container $app) {
            return new MediaController($app['mediable.uploader'], $app['mediable.mover']);
        });
    }
}
