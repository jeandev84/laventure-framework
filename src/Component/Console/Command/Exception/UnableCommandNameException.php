<?php

declare(strict_types=1);

namespace Laventure\Component\Console\Command\Exception;

use Throwable;

/**
 * UnableCommandNameException
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Console\Command\Exception
*/
class UnableCommandNameException extends CommandException
{
    /**
     * @param string $message
     * @param array $data
    */
    public function __construct(string $message, array $data = [])
    {
        parent::__construct($message, $data, 404);
    }
}
