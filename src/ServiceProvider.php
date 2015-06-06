<?php namespace Taskforcedev\LaravelForum;

use Illuminate\Support\ServiceProvider as IlluminateServiceProvider;

class ServiceProvider extends IlluminateServiceProvider
{
    public function register()
    {
    }

    public function boot()
    {
        $this->views();
        $this->routes();

        // Publish Config
        $this->publishes([
            __DIR__.'/config/laravel-forum.php' => config_path('laravel-forum.php'),
        ]);

        $this->mergeConfigFrom(
            __DIR__.'/config/laravel-forum.php', 'laravel-forum'
        );

        // Merge default Config
        $this->mergeConfigFrom(
            __DIR__.'/../../../../config/laravel-forum.php', 'laravel-forum'
        );
    }

    public function views()
    {
        $this->loadViewsFrom(__DIR__.'/views', 'laravel-forum');
    }

    public function routes()
    {
        require __DIR__ . '/Http/routes.php';
    }
}
