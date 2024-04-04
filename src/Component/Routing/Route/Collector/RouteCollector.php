<?php

declare(strict_types=1);

namespace Laventure\Component\Routing\Route\Collector;

use Closure;
use Laventure\Component\Routing\Route\Attributes\Route;
use Laventure\Component\Routing\Route\Collection\RouteCollection;
use Laventure\Component\Routing\Route\Collection\RouteCollectionInterface;
use Laventure\Component\Routing\Route\Factory\RouteFactory;
use Laventure\Component\Routing\Route\Factory\RouteFactoryInterface;
use Laventure\Component\Routing\Route\Group\Invoker\GroupInvokerFactory;
use Laventure\Component\Routing\Route\Group\Invoker\GroupInvokerFactoryInterface;
use Laventure\Component\Routing\Route\Group\Invoker\GroupInvokerInterface;
use Laventure\Component\Routing\Route\Group\RouteGroup;
use Laventure\Component\Routing\Route\Group\RouteGroupInterface;
use Laventure\Component\Routing\Route\Methods\Enums\HttpMethod;
use Laventure\Component\Routing\Route\Resolver\RouteResolverFactory;
use Laventure\Component\Routing\Route\Resolver\RouteResolverFactoryInterface;
use Laventure\Component\Routing\Route\Resolver\RouteResolverInterface;
use Laventure\Component\Routing\Route\Resource\Contract\ResourceInterface;
use Laventure\Component\Routing\Route\Resource\Enums\ResourceType;
use Laventure\Component\Routing\Route\Resource\Factory\ResourceFactory;
use Laventure\Component\Routing\Route\Resource\Factory\ResourceFactoryInterface;
use Laventure\Component\Routing\Route\RouteInterface;
use ReflectionClass;
use ReflectionException;

/**
 * RouteCollector
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Routing\Route\Collector
*/
class RouteCollector extends RouteCollection implements RouteCollectorInterface
{
    /**
     * @var RouteGroupInterface
     */
    protected RouteGroupInterface $group;



    /**
     * @var RouteFactoryInterface
     */
    protected RouteFactoryInterface $routeFactory;



    /**
     * @var RouteResolverFactoryInterface
     */
    protected RouteResolverFactoryInterface $routeResolverFactory;





    /**
     * @var ResourceFactoryInterface
     */
    protected ResourceFactoryInterface $resourceFactory;




    /**
     * @var GroupInvokerFactoryInterface
     */
    protected GroupInvokerFactoryInterface $groupInvokerFactory;



    /**
     * @var string
     */
    protected string $namespace;




    /**
     * @var array
     */
    protected array $routeMiddlewares = [];



    /**
     * @var array
     */
    protected array $patterns = [];





    /**
     * @var ResourceInterface[]
     */
    public array $resources = [];





    /**
     * @param string $namespace
     */
    public function __construct(string $namespace)
    {
        $this->group                = new RouteGroup();
        $this->routeFactory         = new RouteFactory();
        $this->routeResolverFactory = new RouteResolverFactory();
        $this->resourceFactory      = new ResourceFactory();
        $this->groupInvokerFactory  = new GroupInvokerFactory();
        $this->namespace            = $namespace;
    }



    /**
     * @param string $path
     *
     * @return $this
     */
    public function path(string $path): static
    {
        $this->group->path($path);

        return $this;
    }





    /**
     * @param string $namespace
     *
     * @return $this
     */
    public function namespace(string $namespace): static
    {
        $this->group->namespace($namespace);

        return $this;
    }




    /**
     * @param string $name
     *
     * @return $this
     */
    public function name(string $name): static
    {
        $this->group->name($name);

        return $this;
    }





    /**
     * @param array $middlewares
     *
     * @return $this
     */
    public function middleware(array $middlewares): static
    {
        $this->group->middlewares($middlewares);

        return $this;
    }






    /**
     * @param array $middlewares
     * @return $this
     */
    public function middlewares(array $middlewares): static
    {
        $this->routeMiddlewares[] = $middlewares;

        return $this;
    }




    /**
     * @param array $patterns
     *
     * @return $this
     */
    public function patterns(array $patterns): static
    {
        foreach ($patterns as $name => $pattern) {
            $this->pattern($name, $pattern);
        }

        return $this;
    }







    /**
     * @param string $name
     *
     * @param string $pattern
     *
     * @return $this
     */
    public function pattern(string $name, string $pattern): static
    {
        $this->patterns[$name] = $pattern;

        return $this;
    }






    /**
     * @inheritDoc
     */
    public function map($methods, string $path, mixed $action, string $name = ''): RouteInterface
    {
        return $this->addRoute($this->createRoute($methods, $path, $action, $name));
    }





    /**
     * @inheritDoc
     */
    public function get(string $path, mixed $action, string $name = ''): RouteInterface
    {
        return $this->map(HttpMethod::GET, $path, $action, $name);
    }




    /**
     * @inheritDoc
     */
    public function post(string $path, mixed $action, string $name = ''): RouteInterface
    {
        return $this->map(HttpMethod::POST, $path, $action, $name);
    }



    /**
     * @inheritDoc
     */
    public function put(string $path, mixed $action, string $name = ''): RouteInterface
    {
        return $this->map(HttpMethod::PUT, $path, $action, $name);
    }






    /**
     * @inheritDoc
     */
    public function patch(string $path, mixed $action, string $name = ''): RouteInterface
    {
        return $this->map(HttpMethod::PATCH, $path, $action, $name);
    }




    /**
     * @inheritDoc
     */
    public function delete(string $path, mixed $action, string $name = ''): RouteInterface
    {
        return $this->map(HttpMethod::DELETE, $path, $action, $name);
    }




    /**
     * @inheritDoc
     */
    public function group(array $attributes, Closure $routes): static
    {
        $this->group->group($this->createGroupInvoker($attributes, $routes));

        return $this;
    }





    /**
     * @inheritdoc
     */
    public function resource(string $name, string $controller): static
    {
        return $this->addResource($this->createWebResource($name, $controller));
    }





    /**
     * @inheritDoc
     */
    public function resources(array $resources): static
    {
        foreach ($resources as $name => $controller) {
            $this->resource($name, $controller);
        }

        return $this;
    }





    /**
     * @inheritdoc
     */
    public function apiResource(string $name, string $controller): static
    {
        return $this->addResource($this->createApiResource($name, $controller));
    }





    /**
     * @inheritDoc
     */
    public function apiResources(array $resources): static
    {
        foreach ($resources as $name => $controller) {
            $this->apiResource($name, $controller);
        }

        return $this;
    }







    /**
     * @inheritDoc
     */
    public function addResource(ResourceInterface $resource): static
    {
        $type = $resource->getType();
        $name = $resource->getName();
        $this->patterns(['id' => '\d+', $name => '\d+']);
        $resource->map($this);
        $this->resources[$type][$name] = $resource;

        return $this;
    }






    /**
     * @inheritDoc
     */
    public function hasResource(string $name): bool
    {
        return isset($this->resources[ResourceType::WEB][$name]);
    }





    /**
     * @inheritDoc
     */
    public function getResource(string $name): ?ResourceInterface
    {
        return $this->resources[ResourceType::WEB][$name] ?? null;
    }




    /**
     * @inheritDoc
     */
    public function hasApiResource(string $name): bool
    {
        return isset($this->resources[ResourceType::API][$name]);
    }





    /**
     * @inheritDoc
     */
    public function getApiResource(string $name): ?ResourceInterface
    {
        return $this->resources[ResourceType::API][$name] ?? null;
    }





    /**
     * @return RouteFactoryInterface
     */
    public function getRouteFactory(): RouteFactoryInterface
    {
        return $this->routeFactory;
    }







    /**
     * @return RouteResolverFactoryInterface
     */
    public function getRouteResolverFactory(): RouteResolverFactoryInterface
    {
        return $this->routeResolverFactory;
    }




    /**
     * @inheritDoc
     */
    public function getResources(): array
    {
        return $this->resources;
    }




    /**
     * @return RouteGroupInterface
    */
    public function getGroup(): RouteGroupInterface
    {
        return $this->group;
    }






    /**
     * @param ResourceFactoryInterface $resourceFactory
     * @return $this
    */
    public function withResourceFactory(ResourceFactoryInterface $resourceFactory): static
    {
        $this->resourceFactory = $resourceFactory;

        return $this;
    }





    /**
     * @param RouteGroupInterface $group
     * @return $this
    */
    public function withGroup(RouteGroupInterface $group): static
    {
        $this->group = $group;

        return $this;
    }




    /**
     * @param RouteFactoryInterface $routeFactory
     *
     * @return $this
    */
    public function withRouteFactory(RouteFactoryInterface $routeFactory): static
    {
        $this->routeFactory = $routeFactory;

        return $this;
    }





    /**
     * @param RouteResolverFactoryInterface $routeResolverFactory
     * @return $this
     */
    public function withRouteResolverFactory(RouteResolverFactoryInterface $routeResolverFactory): static
    {
        $this->routeResolverFactory = $routeResolverFactory;

        return $this;
    }





    /**
     * @param GroupInvokerFactoryInterface $groupInvokerFactory
     *
     * @return $this
    */
    public function withGroupInvokerFactory(GroupInvokerFactoryInterface $groupInvokerFactory): static
    {
        $this->groupInvokerFactory = $groupInvokerFactory;

        return $this;
    }





    /**
     * @param $methods
     * @param string $path
     * @param mixed $action
     * @param string $name
     * @return RouteInterface
    */
    public function createRoute($methods, string $path, mixed $action, string $name = ''): RouteInterface
    {
        $resolver    = $this->createRouteResolver();
        $methods     = $resolver->resolveMethods($methods);
        $path        = $resolver->resolvePath($path);
        $action      = $resolver->resolveAction($action);
        $name        = $resolver->resolveName($name);
        $middlewares = $resolver->resolveMiddlewares($this->routeMiddlewares);

        $route = $this->routeFactory->createRoute($methods, $path, $action, $name);

        return $route->wheres($this->patterns)->middlewares($middlewares);
    }





    /**
     * @return RouteResolverInterface
    */
    public function createRouteResolver(): RouteResolverInterface
    {
        return $this->routeResolverFactory->createRouteResolver($this->group, $this->namespace);
    }





    /**
     * @param string $name
     * @param string $controller
     * @return ResourceInterface
    */
    public function createWebResource(string $name, string $controller): ResourceInterface
    {
        return $this->resourceFactory->createWebResource($name, $controller);
    }





    /**
     * @param string $name
     * @param string $controller
     * @return ResourceInterface
     */
    public function createApiResource(string $name, string $controller): ResourceInterface
    {
        return $this->resourceFactory->createApiResource($name, $controller);
    }





    /**
     * @param array $attributes
     * @param Closure $routes
     * @return GroupInvokerInterface
     */
    public function createGroupInvoker(array $attributes, Closure $routes): GroupInvokerInterface
    {
        return $this->groupInvokerFactory->createInvoker($attributes, $routes, $this);
    }




    /**
     * @inheritDoc
    */
    public function addControllers(array $controllers): static
    {
        foreach ($controllers as $controller) {
            $this->addController($controller);
        }

        return $this;
    }






    /**
     * @inheritDoc
    */
    public function addController(string $controller): static
    {
        $reflection = new ReflectionClass($controller);
        $routeAttributes = $reflection->getAttributes(Route::class);
        $prefix     = '';
        $namePrefix = '';

        if (!empty($routeAttributes)) {
            /** @var Route $route */
            $route       = $routeAttributes[0]->newInstance();
            $prefix      = $route->getPath();
            $namePrefix  = $route->getName();
        }

        foreach ($reflection->getMethods() as $method) {
            $methodName = $method->getName();
            $attributes = $method->getAttributes(Route::class);

            if (empty($attributes)) {
                continue;
            }

            foreach ($attributes as $attribute) {
                /** @var Route $route */
                $route    = $attribute->newInstance();
                $methods  = $route->getMethods();
                $path     = $route->getPath();
                $name     = $route->getName();
                $wheres   = $route->getPatterns();
                $this->map($methods, $prefix. $path, [$controller, $methodName], $namePrefix.$name)
                     ->wheres($wheres);
            }
        }

        return $this;
    }
}
