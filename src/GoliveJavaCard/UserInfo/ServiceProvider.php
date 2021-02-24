<?php



namespace Alfredluck\Golivephpsdk\GoliveJavaCard\UserInfo;

use Pimple\Container;
use Pimple\ServiceProviderInterface;

/**
 * Class ServiceProvider
 */
class ServiceProvider implements ServiceProviderInterface
{
    /**
     * {@inheritdoc}.
     */
    public function register(Container $app)
    {
        $app['auth'] = function ($app) {
            return new Client($app);
        };
    }
}
