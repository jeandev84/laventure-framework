<?php

declare(strict_types=1);

namespace Laventure\Component\Console\Command\Contract;

use Laventure\Contract\Lister\ListenableInterface;

/**
 * ListCommandInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Console\Command\Contract
*/
interface ListCommandInterface extends CommandInterface, ListenableInterface
{
    /**
     * @param CommandInterface[] $commands
     * @return $this
    */
    public function withAvailableCommands(array $commands): static;






    /**
     * Returns all available commands
     *
     * @return CommandInterface[]
    */
    public function getAvailableCommands(): array;
}
