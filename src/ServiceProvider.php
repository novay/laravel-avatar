<?php

namespace Novay\Avatar;

use Illuminate\Foundation\Application;
use Illuminate\Support\ServiceProvider as BaseServiceProvider;

class ServiceProvider extends BaseServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('laravel-avatar', function (Application $app) {
            $config = $app->make('config');
            $cache = $app->make('cache.store');

            $avatar = new Avatar($config->get('laravel-avatar'), $cache);
            $avatar->setGenerator($app['laravel-avatar.generator']);

            return $avatar;
        });

        $this->app->bind('laravel-avatar.generator', function (Application $app) {
            $config = $app->make('config');
            $class = $config->get('laravel-avatar.generator');

            return new $class;
        });
    }

    public function provides()
    {
        return ['laravel-avatar', 'laravel-avatar.generator'];
    }

    /**
     * Application is booting.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerConfigurations();
    }

    /**
     * Register the package configurations.
     *
     * @return void
     */
    protected function registerConfigurations()
    {
        $this->mergeConfigFrom($this->packagePath('config/config.php'), 'laravel-avatar');
        $this->publishes([$this->packagePath('config/config.php') => config_path('laravel-avatar.php')], 'config');
    }

    /**
     * Loads a path relative to the package base directory.
     *
     * @param string $path
     * @return string
     */
    protected function packagePath($path = '')
    {
        return sprintf('%s/../%s', __DIR__, $path);
    }
}
