<?php
declare(strict_types=1);

namespace Laventure\Component\Routing\Router;

use Laventure\Component\Routing\Route\Collector\RouteCollector;
use Laventure\Component\Routing\Route\RouteInterface;



/**
 * Router
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Routing\Router
*/
class Router extends RouteCollector implements RouterInterface
{
    /**
     * @inheritDoc
    */
    public function match(string $method, string $path): RouteInterface|false
    {
        foreach ($this->getRoutes() as $route) {
            if ($route->match($method, $path)) {
                return $route;
            }
        }

        return false;
    }




    /**
     * @inheritDoc
    */
    public function generate(string $name, array $params = []): ?string
    {
        return $this->getRoute($name)?->generatePath($params);
    }
}
