<?php

declare(strict_types=1);

namespace Laventure\Component\Console\Command\Exception;

/**
 * EmptyCommandNameException
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Console\Command\Exception
*/
class EmptyCommandNameException extends CommandException
{
    /**
     * @param string $commandClass
     * @param array $data
    */
    public function __construct(string $commandClass, array $data = [])
    {
        parent::__construct("Command ($commandClass) has empty name.", $data, 404);
    }
}
