<?php

namespace Laralum\Laralum;

use Illuminate\Support\ServiceProvider;
use Laralum\Laralum\Commands\LaralumInfo;
use Laralum\Laralum\Commands\LaralumPackages;
use Laralum\Laralum\Commands\LaralumPublish;
use Laralum\Laralum\Commands\LaralumSuperAdmins;
use Laralum\Permissions\PermissionsChecker;

class LaralumServiceProvider extends ServiceProvider
{
    /**
     * The mandatory permissions for the module.
     *
     * @var array
     */
    protected $permissions = [
        [
            'name' => 'Laralum Access',
            'slug' => 'laralum::access',
            'desc' => 'Grants access to all laralum infrastructure',
        ],
    ];

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
        ], 'laralum_config');

        $this->loadViewsFrom(__DIR__.'/Views', 'laralum');

        if (!$this->app->routesAreCached()) {
            require __DIR__.'/Routes/web.php';
            require __DIR__.'/Routes/api.php';
        }

        // Manually register other user packages
        $this->app->register('ConsoleTVs\\Charts\\ChartsServiceProvider');
        $this->app->register('Unicodeveloper\\Identify\\IdentifyServiceProvider');
        $this->app->register('Aitor24\\Localizer\\LocalizerServiceProvider');

        // Make sure the permissions are OK
        PermissionsChecker::check($this->permissions);

        // Mass service provider registerer & menu creator
        foreach (Packages::all() as $package) {
            $provider = Packages::provider($package);
            if ($provider) {
                if (class_exists('Laralum\\'.ucfirst($package)."\\$provider")) {
                    $this->app->register('Laralum\\'.ucfirst($package)."\\$provider");
                } elseif (class_exists('Laralum\\'.strtoupper($package)."\\$provider")) {
                    $this->app->register('Laralum\\'.strtoupper($package)."\\$provider");
                }
            }
        }

        if ($this->app->runningInConsole()) {
            $this->commands([
                LaralumInfo::class,
                LaralumPackages::class,
                LaralumPublish::class,
                LaralumSuperAdmins::class,
            ]);
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
