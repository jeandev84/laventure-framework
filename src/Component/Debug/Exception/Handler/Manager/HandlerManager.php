<?php

declare(strict_types=1);

namespace Laventure\Component\Debug\Exception\Handler\Manager;

use Laventure\Component\Debug\Exception\Handler\ErrorHandlerInterface;
use Laventure\Component\Debug\Exception\Handler\ExceptionHandlerInterface;
use Laventure\Component\Debug\Exception\Handler\HandlerInterface;
use Laventure\Component\Debug\Exception\Handler\Register\HandlerRegistryInterface;

/**
 * HandlerManager
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Debug\Exception\Handler\Manager
 */
class HandlerManager implements HandlerManagerInterface
{
    /**
     * @var HandlerRegistryInterface
    */
    protected HandlerRegistryInterface $register;



    /**
     * @var HandlerInterface[]
    */
    protected array $handlers = [];



    /**
     * @var ExceptionHandlerInterface[]|callable[]
    */
    protected array $exceptionHandlers = [];



    /**
     * @var ErrorHandlerInterface[]|callable[]
    */
    protected array $errorHandlers = [];




    /**
     * @param HandlerRegistryInterface $register
    */
    public function __construct(HandlerRegistryInterface $register)
    {
        $this->register = $register;
    }




    /**
     * @param HandlerInterface $handler
     * @return $this
    */
    public function pushHandler(HandlerInterface $handler): static
    {
        $this->handlers[] = $handler;

        return $this;
    }


    /**
     * @param ExceptionHandlerInterface|callable $handler
     * @return $this
    */
    public function pushExceptionHandler(ExceptionHandlerInterface|callable $handler): static
    {
        $this->exceptionHandlers[] = $handler;

        return $this;
    }





    /**
     * @inheritDoc
    */
    public function run(): void
    {
        $this->registerHandlers();
        $this->registerErrorHandlers();
        $this->registerExceptionHandlers();
    }






    /**
     * @inheritDoc
    */
    public function getHandlers(): array
    {
        return $this->handlers;
    }





    /**
     * @return void
    */
    private function registerHandlers(): void
    {
        foreach ($this->handlers as $handler) {
            $this->register->registerHandler($handler);
        }
    }



    private function registerExceptionHandlers(): void
    {
        foreach ($this->exceptionHandlers as $handler) {
            $this->register->registerExceptionHandler($handler);
        }
    }





    private function registerErrorHandlers(): void
    {
        foreach ($this->errorHandlers as $handler) {
            $this->register->registerErrorHandler($handler);
        }
    }
}
