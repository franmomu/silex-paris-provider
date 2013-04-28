<?php

namespace FranMoreno\Silex\Provider;

use Silex\Application;
use Silex\ServiceProviderInterface;
use FranMoreno\Silex\Service\ParisService;

class ParisServiceProvider implements ServiceProviderInterface
{
    public function register(Application $app)
    {
        $app['paris.initializer'] = $app->protect(function () use ($app) {
            static $initialized = false;

            if ($initialized) {
                return;
            }

            $initialized = true;

            $config = isset($app['idiorm.config']) ? $app['idiorm.config'] : null;
            \ORM::configure($config);

            if (isset($app['paris.model.prefix'])) {
                \Model::$auto_prefix_models = $app['paris.model.prefix'];
            }
        });

        $app['paris'] = $app->share(function ($app) {
            $app['paris.initializer']();

            return new ParisService();
        });

        $app['paris.db'] = $app->share(function ($app) {
            $app['paris.initializer']();

            return \ORM::get_db();
        });
    }

    public function boot(Application $app)
    {
    }
}
