<?php

declare(strict_types=1);

namespace Laventure\Component\Routing\Route\Resource\Info;

use Laventure\Component\Routing\Route\RouteInterface;

/**
 * ResourceInfoInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Routing\Route\Resource\Info
*/
interface ResourceInfoInterface
{
    /**
     * @return array
    */
    public function getMethods(): array;





    /**
     * @return RouteInterface[]
    */
    public function getRoutes(): array;
}
