<?php

declare(strict_types=1);

namespace Laventure\Component\Routing\Route\Resource;

use Laventure\Component\Routing\Route\Collector\RouteCollectorInterface;
use Laventure\Component\Routing\Route\Resource\Contract\ResourceInterface;
use Laventure\Component\Routing\Route\Resource\Info\ResourceInfo;
use Laventure\Component\Routing\Route\Resource\Info\ResourceInfoInterface;
use Laventure\Component\Routing\Route\RouteInterface;

/**
 * Web
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Routing\Route\Web
*/
abstract class Resource implements ResourceInterface
{
    /**
     * @var string
    */
    protected string $type;



    /**
     * @var string
    */
    protected string $name;



    /**
     * @var string
    */
    protected string $controller;





    /**
     * @param string $type
     * @param string $name
     *
     * @param string $controller
    */
    public function __construct(string $type, string $name, string $controller)
    {
        $this->type       = $type;
        $this->name       = strtolower($name);
        $this->controller = $controller;
    }




    /**
     * @param string $suffix
     *
     * @return string
    */
    public function path(string $suffix = ''): string
    {
        return sprintf('%s%s', $this->name, $suffix);
    }






    /**
     * @param string $action
     *
     * @return array
    */
    public function action(string $action): array
    {
        return [$this->controller, $action];
    }







    /**
     * @param string $name
     *
     * @return string
    */
    public function name(string $name): string
    {
        return sprintf('%s.%s', $this->name, $name);
    }





    /**
     * @inheritdoc
    */
    public function getName(): string
    {
        return $this->name;
    }





    /**
     * @inheritdoc
    */
    public function getController(): string
    {
        return $this->controller;
    }




    /**
     * @inheritdoc
    */
    public function getType(): string
    {
        return $this->type;
    }





    /**
     * @inheritDoc
    */
    public function toArray(): array
    {
        return get_object_vars($this);
    }




    /**
     * @inheritDoc
    */
    public function map(RouteCollectorInterface $collector): RouteCollectorInterface
    {
        foreach ($this->getMappedRoutes() as $route) {
            [$methods, $path, $action, $name] = $route;
            $collector->map($methods, $path, $action, $name);
        }

        return $collector;
    }





    /**
     * @inheritDoc
    */
    public function getInfo(): ResourceInfoInterface
    {
        return new ResourceInfo($this);
    }
}
