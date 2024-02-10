<?php

declare(strict_types=1);

namespace Laventure\Component\Container;

use ArrayAccess;
use Closure;
use Laventure\Component\Container\Exception\ContainerException;
use Laventure\Component\Container\Facade\Facade;
use Laventure\Component\Container\Resolver\DependencyResolver;
use Laventure\Component\Container\Service\Provider\ServiceProvider;
use Laventure\Component\Container\Service\Service;
use Laventure\Component\Container\Service\ServiceInterface;
use Laventure\Component\Container\Service\SharedService;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\ContainerInterface;
use Psr\Container\NotFoundExceptionInterface;
use ReflectionClass;
use ReflectionException;
use ReflectionFunction;
use ReflectionFunctionAbstract;
use ReflectionMethod;
use Throwable;

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
     * @var Facade[]
    */
    protected array $facades = [];






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
     * @inheritDoc
    */
    public function has(string $id): bool
    {
        return isset($this->services[$id]);
    }





    /**
     * @inheritDoc
    */
    public function get(string $id)
    {
        $id = $this->find($id);

        if ($this->has($id)) {

            $service = $this->services[$id];
            $value   = $service->value();

            if ($service->shared()) {
                return $this->share($id, $value);
            }

            return $value;
        }

        return $this->resolve($id);
    }




    /**
     * Resolve service
     *
     * @param string $id
     * @return mixed
     * @throws ContainerException
     * @throws ReflectionException
    */
    public function resolve(string $id): mixed
    {
        if ($this->hasInstance($id)) {
            return $this->instances[$id];
        }

        return $this->instances[$id] = $this->make($id);
    }






    /**
     * Create service with parameters
     *
     * @param string $id
     * @param array $with
     * @return mixed
     * @throws ContainerException
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     * @throws ReflectionException
    */
    public function make(string $id, array $with = []): object
    {
        // 1. Inspect the class that we are trying to get from the container
        $reflection = new ReflectionClass($id);

        if (!$reflection->isInstantiable()) {
            throw new ContainerException("Class ($id) is not instantiable.");
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

        return $this->resolved[$id] = $reflection->newInstanceArgs($dependencies);
    }





    /**
     * Create service
     *
     * @param string $id
     * @return mixed
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
     * @throws ContainerException
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     * @throws ReflectionException
    */
    public function callAnonymous(Closure $func, array $with = []): mixed
    {
        $with = $this->resolveDependencies(new ReflectionFunction($func), $with);

        return call_user_func_array($func, $with);
    }







    /**
     * @throws ContainerException
     * @throws NotFoundExceptionInterface
     * @throws ContainerExceptionInterface
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
     * @throws ContainerException
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     * @throws ReflectionException
    */
    public function add(ServiceInterface $service): ServiceInterface
    {
        $service  = $this->resolveService($service);

        return $this->services[$service->id()] = $service;
    }






    /**
     * Remove service
     *
     * @param string $id
     * @return void
    */
    public function remove(string $id): void
    {
        unset(
            $this->services[$id],
            $this->instances[$id]
        );
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
     * @return static
    */
    public static function getInstance(): static
    {
        if (!static::$instance) {
            static::$instance = new static();
        }

        return static::$instance;
    }




    /**
     * @param string $id
     * @return string
    */
    private function find(string $id): string
    {
        return $this->aliases[$id] ?? $id;
    }





    /**
     * @param ReflectionFunctionAbstract $func
     *
     * @param array $with
     *
     * @return array
     * @throws ContainerException
     * @throws NotFoundExceptionInterface
     * @throws ContainerExceptionInterface
     * @throws ReflectionException
    */
    private function resolveDependencies(ReflectionFunctionAbstract $func, array $with = []): array
    {
        return $this->getResolver()->resolveDependencies($func, $with);
    }






    /**
     * @param ServiceInterface $service
     * @return mixed
     * @throws ContainerException
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     * @throws ReflectionException
    */
    private function resolveService(ServiceInterface $service): ServiceInterface
    {
        $value = $service->value();

        if ($service->resolvable()) {
            $service->withValue($this->make($value));
        }

        if ($service->callable()) {
            $service->withValue($this->callAnonymous($value));
        }

        return $service;
    }
}
