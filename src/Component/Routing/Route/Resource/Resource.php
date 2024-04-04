<?php

declare(strict_types=1);

namespace Laventure\Component\Routing\Route\Resource;

use Laventure\Component\Routing\Route\Collector\RouteCollectorInterface;
use Laventure\Component\Routing\Route\Factory\RouteFactory;
use Laventure\Component\Routing\Route\Resource\Contract\ResourceInterface;
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
     * @var string
    */
    protected string $prefix = '';




    /**
     * @var RouteFactory
    */
    protected RouteFactory $routeFactory;





    /**
     * @param string $type
     * @param string $name
     *
     * @param string $controller
    */
    public function __construct(string $type, string $name, string $controller)
    {
        $this->type         = $type;
        $this->name         = strtolower($name);
        $this->controller   = $controller;
        $this->routeFactory = new RouteFactory();
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
    public function map(RouteCollectorInterface $collector): RouteCollectorInterface
    {
        foreach ($this->getRoutes() as $route) {
            $collector->map(
                $route->getMethods(),
                $route->getPath(),
                $route->getAction(),
                $route->getName()
            );
        }

        return $collector;
    }





    /**
     * @param string $suffix
     *
     * @return string
    */
    public function path(string $suffix = ''): string
    {
        $path = $this->name;

        if ($this->prefix) {
            $path = "$this->prefix/$path";
        }

        if ($prefixed = $this->prefixedPath()) {
            $path = "$prefixed/$path";
        }


        if ($suffix) {
            $path .= "/";
        }

        return sprintf('%s%s', $path, trim($suffix, "\\/"));
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
        $name = sprintf('%s.%s', $this->name, $name);

        if ($this->prefix) {
            $name = sprintf('%s.%s', $this->prefix, $name);
        }

        if ($prefixed = $this->prefixedPath()) {
            return sprintf('%s.%s', $prefixed, $name);
        }

        return $name;
    }




    /**
     * @param $methods
     * @param $path
     * @param $action
     * @param $name
     * @return RouteInterface
    */
    public function route($methods, $path, $action, $name): RouteInterface
    {
        return $this->routeFactory->createRoute(
            $methods,
            $this->path($path),
            $this->action($action),
            $this->name($name)
        );
    }





    /**
     * @inheritDoc
    */
    public function getPrefix(): string
    {
        return $this->prefix;
    }





    /**
     * @return string
    */
    public function prefixedPath(): string
    {
        return '';
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
    public function withPrefix(string $prefix): static
    {
        $this->prefix = strtolower($prefix);

        return $this;
    }
}
