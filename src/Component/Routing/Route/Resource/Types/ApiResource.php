<?php

declare(strict_types=1);

namespace Laventure\Component\Routing\Route\Resource\Types;

use Laventure\Component\Routing\Route\Collector\RouteCollectorInterface;
use Laventure\Component\Routing\Route\Resource\Decorator\ResourceCollectorDecorator;
use Laventure\Component\Routing\Route\Resource\Enums\ResourceType;
use Laventure\Component\Routing\Route\Resource\Resource;

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
        $type = ResourceType::API;

        parent::__construct($type, $name, ucfirst($type) . "\\". $controller);
    }




    /**
     * @inheritDoc
    */
    public function getMappedRoutes(): array
    {
        return [
           ['GET|HEAD', $this->path(), $this->action('index'), $this->name('index')] ,
           ['GET', $this->path('/{id}'), $this->action('show'), $this->name('show')],
           ['POST', $this->path(), $this->action('store'), $this->name('store')],
           ['PUT|PATCH', $this->path('/{id}'), $this->action('update'), $this->name('update')],
           ["DELETE", $this->path('/{id}'), $this->action('destroy'), $this->name('destroy')]
        ];
    }





    /**
     * @inheritDoc
    */
    public function path(string $suffix = ''): string
    {
        return parent::path("{$this->prefix()}/". rtrim($suffix, "\\/"));
    }





    /**
     * @inheritDoc
    */
    public function name(string $name): string
    {
        return strtolower($this->type) . ".". parent::name($name);
    }







    /**
     * @return string
    */
    public function prefix(): string
    {
        return strtolower($this->type);
    }
}
