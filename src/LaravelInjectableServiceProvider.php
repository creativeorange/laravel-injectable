<?php

namespace Creativeorange\LaravelInjectable;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class LaravelInjectableServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        Blade::directive('inj', function ($attribute = null) {
            return "<?php LaravelInjectable::set($attribute); ?>";
        });
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        // Register the main class to use with the facade
        $this->app->singleton(LaravelInjectable::class, function () {
            return new LaravelInjectable;
        });
    }
}
