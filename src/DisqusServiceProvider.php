<?php 

namespace Kcdev\Disqus;

use Illuminate\Support\ServiceProvider;

class DisqusServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Bootstrap the application events.
     */
    public function boot()
    {
        $app = $this->app;

        $this->bootConfig();
    }

    /**
     * Booting configure.
     */
    protected function bootConfig()
    {
        $path = __DIR__.'/config/disqus.php';

        $this->mergeConfigFrom($path, 'disqus');

        if (function_exists('config_path')) {
            $this->publishes([$path => config_path('disqus.php')]);
        }
    }

    /**
     * Register the service provider.
     */
    public function register()
    {
        $this->app->singleton('disqus', function ($app) {
            return new Disqus(
                $app['config']['disqus.username']
            );
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['disqus'];
    }
}
