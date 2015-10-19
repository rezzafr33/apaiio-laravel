<?php

namespace Apaiio\Laravel\Tests;

use Illuminate\Config\Repository;
use Illuminate\Foundation\Application;
use Apaiio\Laravel\ApaiIOServiceProvider;

class ApaiIOServiceProviderTest extends \PHPUnit_Framework_TestCase
{
    /** @test */
    public function it_test_service_name_is_provided()
    {
        $app = $this->setupApplication();
        $provider = $this->setupServiceProvider($app);
        $this->assertContains('apaiio', $provider->provides());
    }

    /** @test */
    public function it_test_return_instance_of_apaiio()
    {
        $app = $this->setupApplication();
        $this->setupServiceProvider($app);
        $this->assertInstanceOf('ApaiIO\ApaiIO', $app['apaiio']);
    }

    /** @test */
    public function it_test_config()
    {
        $app = $this->setupApplication();
        $this->setupServiceProvider($app);
        $config = $app['config']->get('apaiio');

        $this->assertArrayHasKey('AWS_API_KEY', $config);
    }

    private function setupApplication()
    {
        $app = new Application();
        $app->setBasePath(sys_get_temp_dir());
        $app->instance('config', new Repository());
        return $app;
    }

    private function setupServiceProvider(Application $app)
    {
        $provider = new ApaiIOServiceProvider($app);
        $app->register($provider);
        $provider->boot();
        return $provider;
    }
}
