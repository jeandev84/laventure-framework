<?php

declare(strict_types=1);

namespace Laventure\Foundation\Generator\Resource;

use Laventure\Component\Config\ConfigInterface;
use Laventure\Component\Filesystem\FilesystemInterface;
use Laventure\Component\Routing\Route\Resource\Contract\ResourceInterface;
use Laventure\Component\Routing\Route\Resource\Resource;
use Laventure\Foundation\Application;
use Laventure\Foundation\Generator\Class\ClassGenerator;
use Laventure\Foundation\Generator\Class\Exception\ClassGeneratorException;
use Laventure\Foundation\Generator\Controller\ControllerGenerator;

/**
 * ResourceGenerator
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Foundation\Generator\Resource
*/
abstract class ResourceGenerator extends ClassGenerator
{
    /**
     * @param Application $app
     * @param FilesystemInterface $filesystem
     * @param ConfigInterface $config
     * @param ControllerGenerator $controllerGenerator
    */
    public function __construct(
        Application $app,
        FilesystemInterface $filesystem,
        ConfigInterface $config,
        protected ControllerGenerator $controllerGenerator
    ) {
        parent::__construct($app, $filesystem, $config);
    }





    /**
     * @param string $resource
     * @return $this
    */
    public function withResource(string $resource): static
    {
        $this->controllerGenerator->withController($resource);

        return $this->withClassName($resource);
    }





    /**
     * @inheritDoc
    */
    public function generate(): bool
    {
        #dd($this->getResource()->getInfo()->getActions());
        #dd($this->getResource()->getRoutes());

        dd($this->getResource()->getController());
    }






    /**
     * @inheritDoc
    */
    public function getBaseNamespace(): string
    {
        return $this->controllerGenerator->getBaseNamespace();
    }







    /**
     * @inheritDoc
    */
    public function getStubPath(): string
    {
        return $this->controllerGenerator->getStubPath();
    }




    /**
     * @inheritDoc
    */
    public function getBaseDir(): string
    {
        return $this->getBaseDir();
    }




    /**
     * @return ResourceInterface
    */
    abstract public function getResource(): ResourceInterface;
}
