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
    public function execute(InputInterface $input, OutputInterface $output): int
    {
        $output->printList($this->list());
        return Command::SUCCESS;
    }




    /**
     * @inheritDoc
    */
    public function withAvailableCommands(array $commands): static
    {
        $this->availableCommands = $commands;

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
     * @return array
    */
    private function getListAvailableCommands(): array
    {
        /*
        $defaultCommands = [];
        $namedCommands   = [];

        foreach ($this->availableCommands as $command) {
            if ($command->hasNameSeparated()) {
                $prefix = $command->getFirstNameSeparated();
                $namedCommands[$prefix][$command->getName()] = $command->descriptionAsString();
            } else {
                $defaultCommands[$command->getName()] = $command->descriptionAsString();
            }
        }

        return [$defaultCommands, $namedCommands];
        */
        return [];
    }




    /**
     * @inheritDoc
    */
    public function list(): mixed
    {
       return [
           'Usage'              => $this->getUsage(),
           'Options'            => $this->getOptionList(),
           'Available commands' => []
       ];
    }
}
