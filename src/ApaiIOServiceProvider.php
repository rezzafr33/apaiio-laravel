<?php

namespace Apaiio\Laravel;

use ApaiIO\ApaiIO;
use Illuminate\Support\ServiceProvider;
use ApaiIO\Configuration\GenericConfiguration;

class ApaiIOServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = true;

    /**
     * Bootstrap the configuration
     *
     * @return void
     */
    public function boot()
    {
        $source = realpath(__DIR__ . '/../config/config.php');
        if (class_exists('Illuminate\Foundation\Application', false)) {
            $this->publishes([$source => config_path('apaiio.php')]);
        }
        $this->mergeConfigFrom($source, 'apaiio');
    }

    /**
     * Register the application services.
     *
     * @return ApaiIO\ApaiIO
     */
    public function register()
    {
        $this->app->singleton('apaiio', function ($app) {
            return new ApaiIO($this->setConfiguration($app));
        });

        $this->app->alias('apaiio', 'ApaiIO\ApaiIO');
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['apaiio', 'ApaiIO\ApaiIO'];
    }

    /**
     * Set GenericConfiguration
     *
     * @param Application $app
     * @return GenericConfiguration
     */
    protected function setConfiguration($app)
    {
        $config = $app['config']->get('apaiio');
        $conf = (new GenericConfiguration())
            ->setCountry($config['ENDPOINT'])
            ->setAccessKey($config['AWS_API_KEY'])
            ->setSecretKey($config['AWS_API_SECRET_KEY'])
            ->setAssociateTag($config['AWS_ASSOCIATE_TAG']);

        if (false === empty($config['REQUEST'])) {
            $conf->setRequest($config['REQUEST']);
        }

        if (false === empty($config['RESPONSE'])) {
            $conf->setResponseTransformer($config['RESPONSE']);
        }

        return $conf;
    }
}
