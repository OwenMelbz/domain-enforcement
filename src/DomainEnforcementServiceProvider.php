<?php

namespace OwenMelbz\DomainEnforcement;

use Illuminate\Support\ServiceProvider;

/**
 * Service provider for DomainEnforcement
 *
 * @author: Owen Melbourne
 */
class DomainEnforcementServiceProvider extends ServiceProvider {

    /**
     * This will be used to register config & view in
     * your package namespace.
     *
     * --> Replace with your package name <--
     */
    protected $packageName = 'domain_enforcement';

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        // Publish the config
        $this->publishes([
            __DIR__.'/../config/config.php' => config_path($this->packageName.'.php'),
        ], 'config');

        if (config('domain_enforcement.enforce_domain') === true) {

            DomainEnforcementAgency::setExceptions(
                config('domain_enforcement.except')
            );

            $this->app->make('Illuminate\Contracts\Http\Kernel')->prependMiddleware(
                DomainEnforcementAgency::class
            );
        }
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom( __DIR__.'/../config/config.php', $this->packageName);
    }

}
