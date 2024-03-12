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
     * @var string
    */
    protected string $controllerName = '';



    /**
     * @var array
    */
    protected array $actions = [];




    /**
     * @param string $controller
     * @param array $actions
     * @return $this
    */
    public function withController(string $controller, array $actions = []): static
    {
        $this->controllerName   = $controller;
        $this->actions          = array_merge($this->actions, $actions);

        return $this;
    }





    /**
     * @inheritDoc
    */
    public function getClassName(): string
    {
        return $this->controllerName;
    }




    /**
     * @inheritDoc
    */
    public function getControllerDir(): string
    {
        return trim($this->config['http.controllers.dir'], DIRECTORY_SEPARATOR);
    }




    /**
     * @inheritDoc
    */
    public function getTargetPath(): string
    {
        return $this->generatePathPHP([
            $this->getControllerDir(),
            $this->getClassName()
        ]);
    }




    /**
     * @inheritDoc
    */
    public function getContent(): string
    {
        return $this->generateStub([
            "DummyNamespace" => $this->config['http.controllers.prefix'],
            "DummyClassName" => $this->controllerName,
            "DummyActions"   => $this->generateActions()
        ]);
    }




    /**
     * @inheritDoc
    */
    public function getStubPath(): string
    {
        return __DIR__.'/stub/controller.stub';
    }




    /**
     * @inheritDoc
    */
    public function getActions(): array
    {
        return $this->actions;
    }




    /**
     * @inheritDoc
    */
    public function generateActions(): string
    {
        if (empty($this->actions)) {
            return '';
        }


        return $this->processGenerateActions();
    }




    /**
     * @return string
    */
    private function processGenerateActions(): string
    {
         return '';
    }
}