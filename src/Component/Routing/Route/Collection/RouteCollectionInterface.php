<?php

declare(strict_types=1);

namespace Laventure\Component\Routing\Route\Collection;

use Laventure\Component\Routing\Route\Route;
use Laventure\Component\Routing\Route\RouteInterface;

/**
 * RouteCollectionInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Routing\Route\Collection
*/
interface RouteCollectionInterface
{
    /**
     * @param RouteInterface $route
     *
     * @return RouteInterface
    */
    public function addRoute(RouteInterface $route): RouteInterface;




    /**
     * Returns all routes
     *
     * @return RouteInterface[]
    */
    public function getRoutes(): array;





    /**
     * Determine if exists route by given name
     *
     * @param string $name
     *
     * @return bool
    */
    public function has(string $name): bool;






    /**
     * Returns named route
     *
     * @param string $name
     *
     * @return RouteInterface|null
    */
    public function getRoute(string $name): ?RouteInterface;
}
