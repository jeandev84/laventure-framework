<?php

declare(strict_types=1);

namespace Laventure\Component\Console\Command\Exception;

use Laventure\Component\Console\Command\Command;
use Laventure\Component\Console\Command\Contract\CommandInterface;
use Laventure\Exceptions\BaseException;
use Throwable;

/**
 * InvalidCommandStatusException
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Console\Command\Exception
*/
class InvalidCommandStatusException extends BaseException
{
    /**
     * @param CommandInterface $command
     * @param string $methodName
     * @param int $status
     * @param array $data
    */
    public function __construct(CommandInterface $command, int $status, string $methodName, array $data = [])
    {
        $methodName   = get_class($command) . "::{$methodName}";
        $statuses = $command->getAvailableStatuses();
        $lookFor  = join(', ', $statuses);

        parent::__construct("Unavailable status ($status) from ($methodName). Use next ($lookFor)", $data, 409);
    }
}
