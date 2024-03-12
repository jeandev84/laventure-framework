<?php

declare(strict_types=1);

namespace Laventure\Component\Http\Storage\Session\Exception;

use Throwable;

/**
 * SessionNotFoundException
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Http\Storage\Session\Exception
 */
class SessionNotFoundException extends SessionException
{
    public function __construct()
    {
        parent::__construct("Session not found", [], 404);
    }
}
