<?php

declare(strict_types=1);

namespace Laventure\Component\Routing\Route\Collection;

use Laventure\Component\Routing\Route\RouteInterface;

/**
 * RouteCollection
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Routing\Route\Collection
 */
class RouteCollection implements RouteCollectionInterface
{
    /**
     * @var RouteInterface[]
    */
    protected array $routes = [];



    /**
     * @var RouteInterface[]
    */
    protected array $namedRoutes = [];



    /**
     * @var array
    */
    protected array $methods = [];




    /**
     * @var array
    */
    protected array $controllers = [];




    /**
     * @var array
    */
    protected array $paths = [];




    /**
     * @inheritDoc
    */
    public function addRoute(RouteInterface $route): RouteInterface
    {
        $methods    = $route->getMethodsAsString();
        $path       = $route->getPath();
        $controller = $route->getController();
        $name       = $route->getName();

        $this->methods[$methods][$path] = $route;
        $this->paths[$path] = $route;

        if ($controller) {
            $this->controllers[$controller][$path] = $route;
        }

        if ($name) {
            $this->namedRoutes[$name] = $route;
        }

        return $this->routes[] = $route;
    }





    /**
     * @inheritDoc
    */
    public function getRoutes(): array
    {
        return $this->routes;
    }






    /**
     * @inheritDoc
    */
    public function has(string $name): bool
    {
        return isset($this->namedRoutes[$name]);
    }





    /**
     * @inheritDoc
    */
    public function getRoute(string $name): ?RouteInterface
    {
        return $this->namedRoutes[$name] ?? null;
    }





    /**
     * @return RouteInterface[]
    */
    public function getNamedRoutes(): array
    {
        return $this->namedRoutes;
    }





    /**
     * @return RouteInterface[]
    */
    public function getMethods(): array
    {
        return $this->methods;
    }






    /**
     * @param string $method
     * @return array
    */
    public function getRoutesByMethod(string $method): array
    {
        return $this->methods[$method] ?? [];
    }





    /**
     * @return array
    */
    public function getControllers(): array
    {
        return $this->controllers;
    }




    /**
     * @param string $controller
     * @return array
    */
    public function getRoutesByController(string $controller): array
    {
        return $this->controllers[$controller] ?? [];
    }





    /**
     * @param string $controller
     * @return bool
    */
    public function hasController(string $controller): bool
    {
        return isset($this->controllers[$controller]);
    }




    /**
     * @param string $path
     * @return RouteInterface|null
    */
    public function getRouteByPath(string $path): ?RouteInterface
    {
        return $this->paths[$path] ?? null;
    }





    /**
     * @return RouteInterface[]
    */
    public function getPaths(): array
    {
        return $this->paths;
    }
}
