<?php

namespace FranMoreno\Silex\Provider;

use Silex\Application;
use Silex\ServiceProviderInterface;
use FranMoreno\Silex\Service\ParisService;

class ParisServiceProvider implements ServiceProviderInterface
{
    public function register(Application $app)
    {
        if (isset($app['idiorm.connection'])) {
            \ORM::configure($app['idiorm.connection']);
        }

        $app['paris'] = $app->share(function ($app) {
            return new ParisService();
        });
    }

    public function boot(Application $app)
    {
    }
}
