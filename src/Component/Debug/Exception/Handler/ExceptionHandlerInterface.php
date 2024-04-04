<?php

declare(strict_types=1);

namespace Laventure\Component\Debug\Exception\Handler;

use Exception;

/**
 * ExceptionHandlerInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Debug\Exception\Handler
*/
interface ExceptionHandlerInterface
{
    /**
     * @param Exception $e
     * @return mixed
    */
    public function handleException(Exception $e): mixed;
}
