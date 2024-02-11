<?php

declare(strict_types=1);

namespace Laventure\Foundation\Container\Service\Providers;

use Laventure\Component\Container\Service\Provider\Contract\BootableServiceProvider;
use Laventure\Component\Container\Service\Provider\ServiceProvider;
use Laventure\Component\Filesystem\Filesystem;
use Laventure\Component\Routing\Route\Collector\RouteCollector;
use Laventure\Component\Routing\Route\Collector\RouteCollectorInterface;
use Laventure\Component\Routing\Router\Router;
use Laventure\Component\Routing\Router\RouterInterface;
use Laventure\Foundation\Http\Controller\Loader\ControllerLoader;

/**
 * RouterServiceProvider
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Foundation\Providers
 */
class RouterServiceProvider extends ServiceProvider implements BootableServiceProvider
{
    /**
     * @var string
    */
    protected string $namespace = "App\\Http\\Controllers";

    protected string $controllerPath = "app/Http/Controllers";

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
    public function boot(): void
    {
        $this->app->singleton(ControllerLoader::class, function () {
            return new ControllerLoader(
                $this->app[Filesystem::class],
                $this->namespace,
                $this->controllerPath
            );
        });

    }


    /**
     * @inheritDoc
    */
    public function register(): void
    {
        $this->app->singleton(RouterInterface::class, function () {
            $router = new Router($this->namespace);
            $router->registerControllers($this->loadControllers());
            return $router;
        });
    }




    /**
     * @return string[]
    */
    private function loadControllers(): array
    {
        return $this->app[ControllerLoader::class]->load();
    }
}
