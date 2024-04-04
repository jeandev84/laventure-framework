<?php

declare(strict_types=1);

namespace Laventure\Foundation\Generator\Controller;

use Laventure\Foundation\Generator\Class\ClassGenerator;

/**
 * ControllerGenerator
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Foundation\Generator\Controller
*/
class ControllerGenerator extends ClassGenerator implements ControllerGeneratorInterface
{
    /**
     * @param string $controller
     * @param array $actions
     * @return $this
    */
    public function withController(string $controller, array $actions = []): static
    {
        return $this->withClassName($controller)->withMethods($actions);
    }






    /**
     * @inheritDoc
    */
    public function getBaseDir(): string
    {
        return $this->trimPath($this->config['routes.controllers.dir']);
    }






    /**
     * @inheritDoc
    */
    public function getNamespace(): string
    {
        return $this->config['routes.controllers.prefix'];
    }





    /**
     * @inheritDoc
    */
    public function getStubPath(): string
    {
        return __DIR__.'/stub/controller.stub';
    }





    /**
     * @return string
    */
    public function getMethodStubPath(): string
    {
        return __DIR__.'/stub/action/default.stub';
    }
}
