<?php

namespace Laralum\Laralum;

use Illuminate\Support\ServiceProvider;

class LaralumServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot(\Illuminate\Routing\Router $router)
    {
        // Load middlewares
        $router->aliasMiddleware('laralum.base', Middleware\LaralumBase::class);
        $router->aliasMiddleware('laralum.auth', Middleware\LaralumAuth::class);

        $this->loadTranslationsFrom(__DIR__.'/Translations', 'laralum');

        $this->publishes([
            __DIR__.'/../config/laralum.php' => config_path('laralum.php'),
        ], 'config');

        $this->publishes([
            __DIR__.'/Assets' => public_path('vendor/laralum'),
        ], 'assets');

        $this->loadViewsFrom(__DIR__.'/Views', 'laralum');

        if (!$this->app->routesAreCached()) {
            require __DIR__.'/Routes/web.php';
        }

        // Manually register other user packages
        $this->app->register('ConsoleTVs\\Charts\\ChartsServiceProvider');

        // Manually register other aliases

        // Mass service provider registerer
        foreach (Packages::all() as $package) {
            $provider = Packages::provider($package);
            if ($provider) {
                $this->app->register('Laralum\\'.ucfirst($package)."\\$provider");
            }
        }
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__.'/../config/laralum.php', 'laralum'
        );
    }
}
