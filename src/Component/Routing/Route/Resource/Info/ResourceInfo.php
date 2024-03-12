<?php

declare(strict_types=1);

namespace Laventure\Component\Routing\Route\Resource\Info;

use Laventure\Component\Routing\Route\Resource\Resource;
use Laventure\Component\Routing\Route\Route;
use Laventure\Component\Routing\Route\RouteInterface;

/**
 * ResourceInfo
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Routing\Route\Resource\Info
*/
class ResourceInfo implements ResourceInfoInterface
{
    /**
     * @param Resource $resource
    */
    public function __construct(
        protected Resource $resource
    ) {
    }




    /**
     * @inheritDoc
    */
    public function getActions(): array
    {
       return array_map(function (RouteInterface $route) {

       }, $this->getRoutes());
    }




    /**
     * @inheritDoc
    */
    public function getRoutes(): array
    {
        $routes = [];

        foreach ($this->resource->getMappedRoutes() as $route) {
            $route   = $this->createRouteFromArray($route);
            $routes[$route->getController()][$route->getActionName()] = $route;
        }

        return $routes;
    }




    /**
     * @param array $route
     * @return RouteInterface
    */
    public function createRouteFromArray(array $route): RouteInterface
    {
        return new Route(
            explode('|', $route[0]),
            $route[1],
            $route[2],
            $route[3]
        );
    }
}
