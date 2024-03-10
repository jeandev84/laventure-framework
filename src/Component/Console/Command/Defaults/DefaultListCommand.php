<?php

declare(strict_types=1);

namespace Laventure\Component\Console\Command\Defaults;

use Laventure\Component\Console\Command\Command;
use Laventure\Component\Console\Command\Contract\CommandInterface;
use Laventure\Component\Console\Command\Contract\ListCommandInterface;
use Laventure\Component\Console\Input\InputInterface;
use Laventure\Component\Console\Output\OutputInterface;
use Laventure\Component\Console\Output\Table\ConsoleTable;

/**
 * DefaultListCommand
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Console\Command\Defaults\List
*/
class DefaultListCommand extends Command implements ListCommandInterface
{
    /**
     * @var string
    */
    protected $name = 'list';




    /**
     * @var CommandInterface[]
    */
    protected array $availableCommands = [];



    /**
     * @inheritDoc
     */
    public function withAvailableCommands(array $commands): static
    {
        foreach ($commands as $command) {
            $this->withAvailableCommand($command);
        }

        return $this;
    }




    /**
     * @param CommandInterface $command
     * @return $this
    */
    public function withAvailableCommand(CommandInterface $command): static
    {
        $this->availableCommands[$command->getName()] = $command;

        return $this;
    }



    /**
     * @inheritDoc
     */
    public function getAvailableCommands(): array
    {
        return $this->availableCommands;
    }





    /**
     * @inheritDoc
    */
    public function execute(InputInterface $input, OutputInterface $output): int
    {
        $output->printList($this->list());
        return Command::SUCCESS;
    }





    /**
     * @return array
    */
    private function getAvailableCommandList(): array
    {
        $availableCommands = [];

        foreach ($this->availableCommands as $command) {
            if ($command->hasNameSeparated()) {
                $prefix = $command->getFirstNameSeparated();
                if (!isset($availableCommands[$prefix])) {
                    $availableCommands[$prefix] = '';
                }
            }
            $availableCommands[$command->getName()] = $command->getDescriptionAsString() ?: 'No Description.';
        }


        return $availableCommands;
    }




    /**
     * @inheritDoc
    */
    public function list(): mixed
    {
       return [
           'Usage'              => $this->getUsage(),
           'Options'            => $this->getOptionList(),
           'Available commands' => $this->getAvailableCommandList()
       ];
    }
}
