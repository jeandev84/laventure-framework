<?php

declare(strict_types=1);

namespace Laventure\Foundation\Generator\Resource;

use Laventure\Component\Config\ConfigInterface;
use Laventure\Component\Console\Input\Option\Exceptions\RequiredOptionException;
use Laventure\Component\Filesystem\FilesystemInterface;
use Laventure\Component\Routing\Route\Resource\Contract\ResourceInterface;
use Laventure\Component\Routing\Route\Resource\Enums\ResourceType;
use Laventure\Component\Routing\Route\Resource\Resource;
use Laventure\Component\Routing\Route\Route;
use Laventure\Component\Routing\Route\RouteInterface;
use Laventure\Foundation\Application;
use Laventure\Foundation\Generator\Class\ClassGenerator;
use Laventure\Foundation\Generator\Class\Exception\ClassGeneratorException;
use Laventure\Foundation\Generator\Controller\ControllerGenerator;
use Laventure\Foundation\Generator\Entity\EntityGenerator;
use Laventure\Foundation\Generator\Entity\Exception\EntityGeneratorException;
use Laventure\Foundation\Generator\Resource\Exception\ResourceGeneratorException;

/**
 * ResourceGenerator
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Foundation\Generator\Resource
*/
abstract class ResourceGenerator extends ControllerGenerator implements ResourceGeneratorInterface
{
    public const CONTROLLER_SUFFIX = 'Controller';


    /**
     * @var string|null
    */
    protected ?string $resource = null;





    /**
     * @param Application $app
     * @param FilesystemInterface $filesystem
     * @param ConfigInterface $config
    */
    public function __construct(
        Application $app,
        FilesystemInterface $filesystem,
        ConfigInterface $config
    ) {
        parent::__construct($app, $filesystem, $config);
    }






    /**
     * @inheritDoc
    */
    public function withResource($resource): static
    {
        return $this->withController($resource);
    }




    /**
     * @return string
    */
    public function getClassName(): string
    {
        return sprintf(
            '%s%s',
            parent::getClassName(),
            static::CONTROLLER_SUFFIX
        );
    }






    /**
     * @return string
     * @throws ResourceGeneratorException
    */
    public function getResourceName(): string
    {
        $resourceName = strtolower(parent::getClassName());

        if (!$resourceName) {
            throw new ResourceGeneratorException(
                "Empty resource name inside ". get_called_class()
            );
        }

        return $resourceName;
    }








    /**
     * @inheritDoc
     * @throws EntityGeneratorException
    */
    public function generateEntity(): bool
    {
        if ($this->entityGenerator->generated()) {
            return true;
        }

        return $this->entityGenerator->generate();
    }




    /**
     * @return string
    */
    public function getControllerName(): string
    {
        return $this->getClassFullName();
    }






    /**
     * @inheritDoc
     */
    public function generateStubMethods(): string
    {
        $methodStubs    = [];
        $resourceRoutes = $this->getResourceRoutes();

        foreach ($resourceRoutes as $action => $route) {
            $methodStubs[] = $this->generateStubMethod($action, $route);
        }

        return join($methodStubs);
    }





    /**
     * @return RouteInterface[]
    */
    public function getResourceRoutes(): array
    {
        $routes = [];
        $resourceRoutes = $this->getResource()
                               ->withPrefix($this->getModule())
                               ->getRoutes();

        foreach ($resourceRoutes as $route) {
            $action = $route->getActionName();
            $route->action([$this->getControllerName(), $action]);
            $routes[$action] = $route;
        }
        return $routes;
    }





    /**
     * @param string $action
     * @param Route $route
     * @return string
     * @throws ClassGeneratorException
    */
    public function generateStubMethod(string $action, Route $route): string
    {
        $methodStub = $this->getMethodStubFile();

        return $methodStub->stub([
            "DummyRoutePath"    => $route->getPath(),
            "DummyRouteMethods" => $this->normalizeRoutMethodsForStub($route->getMethods()),
            "DummyRouteName"    => $route->getName(),
            "DummyActionName"   => $action
        ]);
    }







    /**
     * @return string
    */
    public function getBaseDir(): string
    {
        return join(DIRECTORY_SEPARATOR, [
            parent::getBaseDir(),
            $this->getPrefix()
        ]);
    }





    /**
     * @return string
    */
    public function getNamespace(): string
    {
        $namespace = parent::getNamespace();

        if ($prefix = $this->getPrefix()) {
            $namespace = "$namespace\\$prefix";
        }

        return $namespace;
    }





    /**
     * @return string
    */
    public function getPrefix(): string
    {
        return '';
    }





    /**
     * @param array $methods
     * @return string
    */
    private function normalizeRoutMethodsForStub(array $methods): string
    {
        return "'". join("', '", $methods) . "'";
    }
}
