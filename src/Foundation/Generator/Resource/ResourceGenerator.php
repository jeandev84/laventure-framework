<?php
declare(strict_types=1);

namespace Laventure\Foundation\Generator\Resource;

use Laventure\Component\Config\ConfigInterface;
use Laventure\Component\Filesystem\FilesystemInterface;
use Laventure\Component\Routing\Route\Resource\Contract\ResourceInterface;
use Laventure\Component\Routing\Route\Resource\Resource;
use Laventure\Component\Routing\Route\Route;
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


    /**
     * @var string|null
    */
    protected ?string $resource = null;





    /**
     * @param Application $app
     * @param FilesystemInterface $filesystem
     * @param ConfigInterface $config
     * @param EntityGenerator $entityGenerator
    */
    public function __construct(
        Application $app,
        FilesystemInterface $filesystem,
        ConfigInterface $config,
        protected EntityGenerator $entityGenerator
    ) {
        parent::__construct($app, $filesystem, $config);
        $this->withClassSuffix(static::CONTROLLER_SUFFIX);
    }





    /**
     * @inheritDoc
    */
    public function withResource($resource): static
    {
        $this->entityGenerator->withClassName($resource);

        return $this->withController($resource);
    }









    /**
     * @return string
     */
    public function getResourceName(): string
    {
        return strtolower($this->getClassName());
    }





    /**
     * @return string
     */
    public function getResourcePrefix(): string
    {
        return $this->getResource()->getPrefix();
    }




    /**
     * @inheritDoc
    */
    public function getControllerName(): string
    {
        $controllerName = parent::getControllerName();

        if($prefix = $this->getResourcePrefix()) {
            return sprintf('%s\\%s', $prefix, $controllerName);
        }

        return $controllerName;
    }







    /**
     * @inheritDoc
    */
    public function generate(): bool
    {
        dd($this->getContent());

        if ($status = $this->generateEntity()) {
            $status = $this->generateResourceController();
        }

        return $status;
    }





    /**
     * @inheritDoc
     * @throws EntityGeneratorException
    */
    public function generateEntity(): bool
    {
        return $this->entityGenerator->generate();
    }






    /**
     * @inheritDoc
     */
    public function generateStubMethods(): string
    {
        $methodStubs = [];

        foreach ($this->getResource()->getRoutes() as $action => $route) {
            $route->action([$this->getControllerName(), $action]);
            $methodStubs[] = $this->generateStubMethod($action, $route);
        }

        return join($methodStubs);
    }





    /**
     * @param string $action
     * @param Route $route
     * @return string
    */
    public function generateStubMethod(string $action, Route $route): string
    {
        $methodStub = $this->file($this->getMethodStubPath());

        return $methodStub->stub([
            "DummyRoutePath"    => $route->getPath(),
            "DummyRouteMethods" => $route->getMethodsAsString(', '),
            "DummyRouteName"    => $route->getName(),
            "DummyActionName"   => $action
        ]);
    }





    /**
     * @return ResourceInterface
    */
    abstract public function getResource(): ResourceInterface;
}
