<?php

declare(strict_types=1);

namespace Laventure\Component\Console\Command\Defaults;

use Laventure\Component\Console\Command\Command;
use Laventure\Component\Console\Command\Contract\CommandInterface;
use Laventure\Component\Console\Command\Contract\ListCommandInterface;

/**
 * ListCommand
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Console\Command\Defaults
*/
class ListCommand extends Command implements ListCommandInterface
{
    /**
     * @var CommandInterface[]
    */
    protected array $commands = [];



    /**
     * @param CommandInterface[] $commands
    */
    public function __construct(array $commands)
    {
        parent::__construct('list');
        $this->commands = $commands;
    }




    /**
     * @inheritDoc
    */
    public function getCommands(): array
    {

    }
}
