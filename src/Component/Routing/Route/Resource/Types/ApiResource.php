<?php

declare(strict_types=1);

namespace Laventure\Component\Routing\Route\Resource\Types;

use Laventure\Component\Routing\Route\Collector\RouteCollectorInterface;
use Laventure\Component\Routing\Route\Resource\Decorator\ResourceCollectorDecorator;
use Laventure\Component\Routing\Route\Resource\Enums\ResourceType;
use Laventure\Component\Routing\Route\Resource\Resource;
use Laventure\Component\Routing\Route\Route;

/**
 * ApiResource
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Routing\Route\Web\Drivers
*/
class ApiResource extends Resource
{
    /**
     * @param string $name
     * @param string $controller
    */
    public function __construct(string $name, string $controller)
    {
        parent::__construct(ResourceType::API, $name, $controller);
    }




    /**
     * @inheritDoc
    */
    public function getRoutes(): array
    {
        return [
           $this->route(['GET|HEAD'], '', 'index', 'index'),
           $this->route(['GET'], '/{id}', 'show', 'show'),
           $this->route(['POST'], '', 'store', 'store'),
           $this->route(['PUT|PATCH'], '/{id}', 'update', 'update'),
           $this->route(['DELETE'], '/{id}', 'destroy', 'destroy'),
        ];
    }






    /**
     * @return string
    */
    public function prefixedPath(): string
    {
        return strtolower($this->type);
    }




    /**
     * @inheritDoc
    */
    public function getPrefix(): string
    {
        return ucfirst($this->type);
    }
}
