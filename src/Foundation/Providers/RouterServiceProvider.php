<?php

declare(strict_types=1);

namespace Laventure\Foundation\Providers;

use Laventure\Component\Config\Config;
use Laventure\Component\Container\Service\Provider\Contract\BootableServiceProvider;
use Laventure\Component\Container\Service\Provider\ServiceProvider;
use Laventure\Component\Filesystem\Filesystem;
use Laventure\Component\Routing\Route\Collector\RouteCollector;
use Laventure\Component\Routing\Route\Collector\RouteCollectorInterface;
use Laventure\Component\Routing\Router\Router;
use Laventure\Component\Routing\Router\RouterInterface;
use Laventure\Foundation\Loader\Controller\ControllerLoader;

/**
 * RouterServiceProvider
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Foundation\Providers
 */
class RouterServiceProvider extends ServiceProvider
{
    /**
     * @var array
    */
    protected array $provides = [
        RouterInterface::class => [
            Router::class,
            RouteCollector::class,
            RouteCollectorInterface::class,
            'router'
        ]
    ];






    /**
     * @inheritDoc
    */
    public function register(): void
    {
        $this->app->singleton(RouterInterface::class, function (
            ControllerLoader $controllerLoader
        ) {
            $config = $controllerLoader->getConfig();
            $router = new Router($config['routes.controllers.prefix']);
            $router->addControllers($controllerLoader->load());
            return $router;
        });
    }
}
