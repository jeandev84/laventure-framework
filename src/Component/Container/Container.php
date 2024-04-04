<?php

declare(strict_types=1);

namespace Laventure\Component\Container;

use ArrayAccess;
use Closure;
use Laventure\Component\Container\Exception\ContainerException;
use Laventure\Component\Container\Facade\Facade;
use Laventure\Component\Container\Resolver\DependencyResolver;
use Laventure\Component\Container\Service\Provider\Contract\BootableServiceProvider;
use Laventure\Component\Container\Service\Provider\ServiceProvider;
use Laventure\Component\Container\Service\Service;
use Laventure\Component\Container\Service\ServiceInterface;
use Laventure\Component\Container\Service\SharedService;
use Psr\Container\ContainerInterface;
use ReflectionClass;
use ReflectionException;
use ReflectionFunction;
use ReflectionFunctionAbstract;
use ReflectionMethod;

/**
 * Container
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Container
*/
class Container implements ContainerInterface, ArrayAccess
{
    /**
     * @var static
    */
    protected static $instance;



    /**
     * @var ServiceInterface[]
    */
    protected array $services = [];



    /**
     * @var array
    */
    protected array $aliases = [];



    /**
     * @var object[]
    */
    protected array $instances = [];




    /**
     * @var array
    */
    protected array $resolved = [];



    /**
     * @var array
    */
    protected array $shared = [];




    /**
     * @var ServiceProvider[]
    */
    protected array $providers = [];




    /**
     * @var array
    */
    protected array $provides = [];



    /**
     * @var Facade[]
    */
    protected array $facades = [];






    /**
     * Returns container instance
     *
     * @return static
    */
    public static function getInstance(): static
    {
        if (!static::$instance) {
            static::$instance = new self();
        }

        return static::$instance;
    }





    /**
     * @param ContainerInterface $instance
     * @return static
    */
    public static function setInstance(ContainerInterface $instance): ContainerInterface
    {
        return static::$instance = $instance;
    }








    /**
     * @param string $id
     * @param array $aliases
     * @return $this
    */
    public function aliases(string $id, array $aliases): static
    {
        foreach ($aliases as $alias) {
            $this->aliases[$alias] = $id;
        }

        return $this;
    }







    /**
     * Register service in container
     *
     * @param string $id
     * @param mixed $value
     * @return ServiceInterface
    */
    public function bind(string $id, mixed $value): ServiceInterface
    {
        return $this->add(new Service($id, $value));
    }






    /**
     * @param array $bindings
     *
     * @return $this
    */
    public function binds(array $bindings): static
    {
        foreach ($bindings as $id => $value) {
            $this->bind($id, $value);
        }

        return $this;
    }








    /**
     * @param string $id
     * @param mixed $value
     * @return $this
    */
    public function singleton(string $id, mixed $value): static
    {
        $this->add(new SharedService($id, $value));

        return $this;
    }








    /**
     * @param array $bindings
     * @return $this
    */
    public function singletons(array $bindings): static
    {
        foreach ($bindings as $id => $value) {
            $this->singleton($id, $value);
        }

        return $this;
    }








    /**
     * Register instance
     *
     * @param string $id
     * @param object $value
     * @return mixed
    */
    public function instance(string $id, object $value): static
    {
        $this->instances[$id] = $value;

        return $this;
    }







    /**
     * @param array $instances
     *
     * @return $this
    */
    public function instances(array $instances): static
    {
        foreach ($instances as $id => $instance) {
            $this->instance($id, $instance);
        }

        return $this;
    }





    /**
     * @param string $id
     * @param mixed $value
     * @return mixed
    */
    public function share(string $id, mixed $value): mixed
    {
        if (!isset($this->shared[$id])) {
            $this->shared[$id] = $value;
        }

        return $this->shared[$id];
    }






    /**
     * @param string $id
     * @return bool
    */
    public function shared(string $id): bool
    {
        return isset($this->shared[$id]);
    }







    /**
     * Remove service
     *
     * @param string $id
     * @return void
    */
    public function remove(string $id): void
    {
        unset($this->services[$id]);
    }





    /**
     * @inheritDoc
    */
    public function has(string $id): bool
    {
        return isset($this->services[$id]);
    }







    /**
     * @inheritDoc
     * @throws ReflectionException
    */
    public function get(string $id)
    {
        $id = $this->alias($id);

        if ($this->has($id)) {

            $service = $this->resolveService($this->services[$id]);

            if ($service->shared()) {
                return $this->share($id, $service->value());
            }

            return $service->value();
        }

        return $this->resolve($id);
    }







    /**
     * Resolve service
     *
     * @param string $id
     * @return object
     * @throws ContainerException
     * @throws ReflectionException
    */
    public function resolve(string $id): object
    {
        if ($this->hasInstance($id)) {
            $instance = $this->instances[$id];
        } else {
            $instance = $this->make($id);
        }

        return $this->resolved[$id] = $instance;
    }








    /**
     * @param string $id
     * @return bool
    */
    public function resolved(string $id): bool
    {
        return isset($this->resolved[$id]);
    }









    /**
     * Create service with parameters
     *
     * @param string $id
     * @param array $with
     * @return object
     * @throws ContainerException
     * @throws ReflectionException
    */
    public function make(string $id, array $with = []): object
    {
        // 1. Inspect the class that we are trying to get from the container
        $reflection = new ReflectionClass($id);

        if (!$reflection->isInstantiable()) {
            throw new ContainerException("$id is not instantiable.");
        }

        // 2. Inspect the constructor of the class
        $constructor = $reflection->getConstructor();

        if (!$constructor) {
            return $reflection->newInstance();
        }


        // 3. Inspect the constructor parameters (dependencies)
        if (!$constructor->getParameters()) {
            return $reflection->newInstance();
        }

        $dependencies = $this->resolveDependencies($constructor, $with);

        return $reflection->newInstanceArgs($dependencies);
    }





    /**
     * Create service
     *
     * @param string $id
     * @return object
     * @throws ContainerException
     * @throws ReflectionException
    */
    public function factory(string $id): object
    {
        return $this->make($id);
    }






    /**
     * @param Closure $func
     *
     * @param array $with
     *
     * @return mixed
     * @throws ReflectionException
    */
    public function callAnonymous(Closure $func, array $with = []): mixed
    {
        $with = $this->resolveDependencies(new ReflectionFunction($func), $with);

        return call_user_func_array($func, $with);
    }





    /**
     * @param string $class
     * @param string $method
     * @param array $with
     * @return mixed
     * @throws ContainerException
     * @throws ReflectionException
     */
    public function call(string $class, string $method, array $with = []): mixed
    {
        $object = $this->make($class);
        $method = new ReflectionMethod($class, $method);

        if ($object instanceof ContainerAwareInterface) {
            $object->setContainer($this);
        }

        $with = $this->resolveDependencies($method, $with);

        return call_user_func_array([$object, $method->name], $with);
    }







    /**
     * @param ServiceInterface $service
     *
     * @return ServiceInterface
    */
    public function add(ServiceInterface $service): ServiceInterface
    {
        return $this->services[$service->id()] = $service;
    }






    /**
     * @param string $provider
     *
     * @return bool
    */
    public function hasProvider(string $provider): bool
    {
        return isset($this->providers[$provider]);
    }







    /**
     * @param string $provider
     * @return $this
     *
     * @throws ContainerException
     * @throws ReflectionException
    */
    public function addProvider(string $provider): static
    {
        if (!$this->hasProvider($provider)) {
            $service = $this->makeProvider($provider);
            $this->addProvides($provider, $service->getProvides());
            $service->setContainer($this);
            $this->bootProvider($service);
            $service->register();
            $this->providers[$provider] = $service;
        }

        return $this;
    }





    /**
     * @param array $providers
     *
     * @return $this
     * @throws ContainerException
     * @throws ReflectionException
    */
    public function addProviders(array $providers): static
    {
        foreach ($providers as $provider) {
            $this->addProvider($provider);
        }

        return $this;
    }






    /**
     * @return array
    */
    public function getProviders(): array
    {
        return $this->providers;
    }




    /**
     * @return array
    */
    public function getProvides(): array
    {
        return $this->provides;
    }






    /**
     * @param string $facade
     * @return bool
     */
    public function hasFacade(string $facade): bool
    {
        return isset($this->facades[$facade]);
    }







    /**
     * @param string $id
     * @return $this
     * @throws ContainerException
     * @throws ReflectionException
     */
    public function addFacade(string $id): static
    {
        if (!$this->hasFacade($id)) {
            $facade             = $this->makeFacade($id);
            $facade->setContainer($this);
            $this->facades[$id] = $facade;
        }

        return $this;
    }





    /**
     * @param array $facades
     *
     * @return $this
     * @throws ContainerException
     * @throws ReflectionException
    */
    public function addFacades(array $facades): static
    {
        foreach ($facades as $facade) {
            $this->addFacade($facade);
        }

        return $this;
    }





    /**
     * @return array
    */
    public function getFacades(): array
    {
        return $this->facades;
    }






    /**
     * @return array
    */
    public function getResolved(): array
    {
        return $this->resolved;
    }






    /**
     * @return array
    */
    public function getAliases(): array
    {
        return $this->aliases;
    }






    /**
     * @return array
    */
    public function getInstances(): array
    {
        return $this->instances;
    }






    /**
     * @return array
    */
    public function getShared(): array
    {
        return $this->shared;
    }






    /**
     * clean container
     *
     * @return void
    */
    public function clear(): void
    {
        $this->services  = [];
        $this->instances = [];
        $this->aliases   = [];
        $this->resolved  = [];
        $this->shared    = [];
        $this->providers = [];
        $this->provides  = [];
        $this->facades   = [];
    }




    /**
     * @return DependencyResolver
    */
    public function getResolver(): DependencyResolver
    {
        return new DependencyResolver($this);
    }







    /**
     * Returns services
     *
     * @return ServiceInterface[]
    */
    public function getServices(): array
    {
        return $this->services;
    }





    /**
     * Determine if given name has instance
     *
     * @param string $id
     * @return bool
    */
    public function hasInstance(string $id): bool
    {
        return isset($this->instances[$id]);
    }







    /**
     * @param string $id
     * @return void
    */
    public function removeInstance(string $id): void
    {
        unset($this->instances[$id]);
    }







    /**
     * @inheritDoc
    */
    public function offsetExists(mixed $offset): bool
    {
        return $this->has($offset);
    }




    /**
     * @inheritDoc
    */
    public function offsetGet(mixed $offset): mixed
    {
        return $this->get($offset);
    }





    /**
     * @inheritDoc
    */
    public function offsetSet(mixed $offset, mixed $value): void
    {
        $this->bind($offset, $value);
    }




    /**
     * @inheritDoc
    */
    public function offsetUnset(mixed $offset): void
    {
        $this->remove($offset);
    }




    /**
     * @param $name
     * @return array|bool|mixed|object|string|null
    */
    public function __get($name)
    {
        return $this[$name];
    }




    /**
     * @param $name
     * @param $value
    */
    public function __set($name, $value)
    {
        $this[$name] = $value;
    }






    /**
     * @param string $id
     * @return string
    */
    private function alias(string $id): string
    {
        return $this->aliases[$id] ?? $id;
    }








    /**
     * @param ReflectionFunctionAbstract $func
     *
     * @param array $with
     *
     * @return array
    */
    private function resolveDependencies(ReflectionFunctionAbstract $func, array $with = []): array
    {
        return (function () use ($func, $with) {
            return $this->getResolver()->resolveDependencies($func, $with);
        })();
    }







    /**
     * @param ServiceInterface $service
     * @return ServiceInterface
    */
    private function resolveService(ServiceInterface $service): ServiceInterface
    {
        return (function () use ($service) {

            $value = $service->value();

            if ($service->resolvable()) {
                $service->withValue($this->resolve($value));
            } elseif ($service->callable()) {
                $service->withValue($this->callAnonymous($value));
            }

            return $service;
        })();
    }




    /**
     * @param string $provider
     * @return ServiceProvider
     * @throws ContainerException
     * @throws ReflectionException
    */
    private function makeProvider(string $provider): ServiceProvider
    {
        return $this->make($provider);
    }






    /**
     * @param string $facade
     * @return Facade
     * @throws ContainerException
     * @throws ReflectionException
    */
    private function makeFacade(string $facade): Facade
    {
        return $this->make($facade);
    }






    /**
     * @param ServiceProvider $provider
     *
     * @return void
    */
    private function bootProvider(ServiceProvider $provider): void
    {
        if($provider instanceof BootableServiceProvider) {
            $provider->boot();
        }
    }






    /**
     * @param string $service
     *
     * @param array $provides
     *
     * @return void
    */
    private function addProvides(string $service, array $provides): void
    {
        foreach ($provides as $id => $aliases) {
            $this->aliases($id, $aliases);
        }

        $this->provides[$service] = $provides;
    }




    /**
     * @param mixed $subclass
     * @param string $class
     * @return bool
    */
    private function subclassOf(mixed $subclass, string $class): bool
    {
        return is_subclass_of($subclass, $class);
    }
}
