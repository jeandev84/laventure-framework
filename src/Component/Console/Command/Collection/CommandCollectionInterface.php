<?php

declare(strict_types=1);

namespace Laventure\Component\Console\Command\Collection;

use Laventure\Component\Console\Command\Contract\CommandInterface;
use Laventure\Component\Console\Command\Contract\ListCommandInterface;
use Laventure\Component\Console\Command\Contract\OptionCommandInterface;
use Laventure\Component\Console\Command\Usage\UsageCommandInterface;

/**
 * CommandCollectionInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Console\Command\Collection
 */
interface CommandCollectionInterface
{
    /**
     * @param CommandInterface $command
     * @return $this
     */
    public function addCommand(CommandInterface $command): static;









    /**
     * @return CommandInterface[]
    */
    public function getCommands(): array;








    /**
     * @param $name
     * @return bool
    */
    public function hasCommand($name): bool;








    /**
     * Returns command to execute
     *
     * @param $name
     * @return CommandInterface
    */
    public function getCommand($name): CommandInterface;
}
