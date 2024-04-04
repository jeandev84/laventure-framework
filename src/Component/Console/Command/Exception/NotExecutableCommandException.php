<?php

declare(strict_types=1);

namespace Laventure\Component\Console\Command\Exception;

use Laventure\Exceptions\BaseException;
use RuntimeException;

/**
 * NotExecutableCommandException
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Console\Command\Exception
*/
class NotExecutableCommandException extends BaseException
{
    /**
     * @param $command
     * @param array $context
    */
    public function __construct($command, array $context = [])
    {
        parent::__construct("Could not execute command ($command)", $context, 409);
    }
}
