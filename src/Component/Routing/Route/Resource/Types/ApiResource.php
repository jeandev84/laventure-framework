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
    public function getMappedRoutes(): array
    {
        return [
           new Route(['GET|HEAD'], $this->path(), $this->action('index'), $this->name('index')),
           new Route(['GET'], $this->path('/{id}'), $this->action('show'), $this->name('show')),
           new Route(['POST'], $this->path(), $this->action('store'), $this->name('store')),
           new Route(['PUT|PATCH'], $this->path('/{id}'), $this->action('update'), $this->name('update')),
           new Route(['DELETE'], $this->path('/{id}'), $this->action('destroy'), $this->name('destroy')),
        ];
    }






    /**
     * @return string
    */
    public function prefixed(): string
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
