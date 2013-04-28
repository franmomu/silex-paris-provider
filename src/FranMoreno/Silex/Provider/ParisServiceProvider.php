<?php

namespace FranMoreno\Silex\Provider;

use Silex\Application;
use Silex\ServiceProviderInterface;
use FranMoreno\Silex\Service\ParisService;

class ParisServiceProvider implements ServiceProviderInterface
{
    public function register(Application $app)
    {
        $app['paris'] = $app->share(function ($app) {

            $connection = isset($app['idiorm.connection']) ? $app['idiorm.connection'] : null;
            \ORM::configure($connection);

            if (isset($app['paris.model.prefix'])) {
                \Model::$auto_prefix_models = $app['paris.model.prefix'];
            }

            return new ParisService();
        });
    }

    public function boot(Application $app)
    {
    }
}
