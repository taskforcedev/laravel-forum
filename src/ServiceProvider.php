<?php namespace Taskforcedev\LaravelForum;

use Illuminate\Support\ServiceProvider as IlluminateServiceProvider;

/**
 * Class ServiceProvider
 *
 * @package Taskforcedev\LaravelForum
 */
class ServiceProvider extends IlluminateServiceProvider
{
    public function register()
    {
    }

    /**
     * Loads config, views and routes from the package and parent app.
     */
    public function boot()
    {
        $this->views();
        $this->routes();

        // Publish Config
        $this->publishes([
            __DIR__.'/config/laravel-forum.php' => config_path('laravel-forum.php'),
        ], 'config');

        $this->mergeConfigFrom(
            __DIR__.'/config/laravel-forum.php', 'laravel-forum'
        );

        // Merge default Config
        $this->mergeConfigFrom(
            __DIR__.'/../../../../config/laravel-forum.php', 'laravel-forum'
        );
    }

    /**
     * Loads the views into the laravel-forum view namespace.
     */
    public function views()
    {
        $this->loadViewsFrom(__DIR__.'/views', 'laravel-forum');
    }

    /**
     * Loads the routes.
     */
    public function routes()
    {
        require __DIR__ . '/Http/routes.php';
    }
}
