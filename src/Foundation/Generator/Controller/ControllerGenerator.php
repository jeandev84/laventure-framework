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
     * @var array
    */
    protected array $actions = [];




    /**
     * @param array $actions
     * @return $this
    */
    public function withActions(array $actions): static
    {
        $this->actions = array_merge($this->actions, $actions);

        return $this;
    }





    /**
     * @inheritDoc
    */
    public function getClassName(): string
    {

    }




    /**
     * @inheritDoc
    */
    public function getTargetPath(): string
    {

    }




    /**
     * @inheritDoc
    */
    public function getContent(): string
    {

    }




    /**
     * @inheritDoc
    */
    public function getStubPath(): string
    {

    }




    /**
     * @inheritDoc
    */
    public function getActions(): array
    {
        return [];
    }




    /**
     * @inheritDoc
    */
    public function generateActions(): string
    {
        return '';
    }
}