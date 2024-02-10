<?php

declare(strict_types=1);

namespace Laventure\Component\Debug\Exception\Handler;

use ErrorException;

/**
 * ErrorHandlerInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Debug\Exception\Handler
 */
interface ErrorHandlerInterface
{
    /**
     * @param ErrorException $exception
     * @return mixed
    */
    public function handleError(ErrorException $exception): mixed;
}
