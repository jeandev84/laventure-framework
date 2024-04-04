<?php

declare(strict_types=1);

namespace Laventure\Component\Debug\Exception\Handler\Register;

use Laventure\Component\Debug\Exception\Handler\HandlerInterface;

/**
 * HandlerRegistryInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Debug\Exception\Handler\Register
 */
interface HandlerRegistryInterface
{
    /**
     * Set error handler
     *
     * @param callable $handler
     * @return mixed
    */
    public function registerErrorHandler(callable $handler): mixed;




    /**
     * Set exception handler
     *
     * @param callable $handler
     * @return mixed
    */
    public function registerExceptionHandler(callable $handler): mixed;






    /**
     * @param callable $func
     * @return mixed
    */
    public function registerShutdownFunction(callable $func): mixed;





    /**
     * @param HandlerInterface $handler
     * @return mixed
    */
    public function registerHandler(HandlerInterface $handler): mixed;
}
