<?php

declare(strict_types=1);

namespace Laventure\Foundation\Facade\Route;

use Closure;
use Laventure\Component\Container\Facade\Facade;
use Laventure\Component\Routing\Route\Collector\RouteCollector;
use Laventure\Component\Routing\Route\RouteInterface;
use Laventure\Component\Routing\Router\RouterInterface;

/**
 * Route
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @method static RouteCollector prefix(string $prefix)
 * @method static RouteCollector namespace(string $module)
 * @method static RouteCollector name(string $name)
 * @method static RouteCollector middleware(array $middlewares)
 * @method static RouteCollector storage(string $name, string $controller)
 * @method static RouteCollector resources(array $resources)
 * @method static RouteCollector apiResource(string $name, string $controller)
 * @method static RouteCollector apiResources(array $resources)
 * @method static RouteInterface map(array|string $methods, string $path, mixed $action, string $name = '')
 * @method static RouteInterface get(string $path, $action, string $name = '')
 * @method static RouteInterface post(string $path, $action, string $name = '')
 * @method static RouteInterface put(string $path, $action, string $name = '')
 * @method static RouteInterface patch(string $path, $action, string $name = '')
 * @method static RouteInterface delete(string $path, $action, string $name = '')
 * @method static RouteInterface group(array $attributes, Closure $routes)
 * @method static string generate(string $name, array $parameters = [])
 *
 * @package  Laventure\Foundation\Container\Facade\Route
*/
class Route extends Facade
{
    /**
     * @return string
    */
    protected static function getFacadeAccessor(): string
    {
        return RouterInterface::class;
    }
}
