<?php

declare(strict_types=1);

namespace Laventure\Component\Debug\Exception\Handler\Register;

use Laventure\Component\Debug\Exception\Handler\ErrorHandlerInterface;
use Laventure\Component\Debug\Exception\Handler\ExceptionHandlerInterface;
use Laventure\Component\Debug\Exception\Handler\HandlerInterface;

/**
 * HandlerRegistry
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Debug\Exception\Handler\Register
*/
class HandlerRegistry implements HandlerRegistryInterface
{
    /**
     * @inheritDoc
    */
    public function registerErrorHandler(ErrorHandlerInterface|callable $handler): static
    {
        if ($handler instanceof ErrorHandlerInterface) {
            $handler = [$handler, 'handleError'];
        }

        set_error_handler($handler);

        return $this;
    }




    /**
     * @inheritDoc
    */
    public function registerExceptionHandler(ExceptionHandlerInterface|callable $handler): static
    {
        if ($handler instanceof ExceptionHandlerInterface) {
            $handler = [$handler, 'handleException'];
        }

        set_exception_handler($handler);

        return $this;
    }




    /**
     * @inheritDoc
    */
    public function registerShutdownFunction(callable $func): static
    {
        register_shutdown_function($func);

        return $this;
    }



    /**
     * @inheritDoc
    */
    public function registerHandler(HandlerInterface $handler): static
    {
        $this->registerErrorHandler([$handler, 'handle']);
        $this->registerExceptionHandler([$handler, 'handle']);

        return $this;
    }
}
