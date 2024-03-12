<?php

declare(strict_types=1);

namespace Laventure\Component\Routing\Route\Exception;

use Throwable;

/**
 * NamedRouteNotFoundException
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Routing\Route\Exception
 */
class RouteNotFoundException extends RouteException
{
    /**
     * @param string $route
     * @param array $data
    */
    public function __construct(string $route, array $data = [])
    {
        parent::__construct("Not found route ($route).", $data, 404);
    }
}
