<?php

declare(strict_types=1);

namespace Laventure\Component\Console\Command\Defaults;

use Laventure\Component\Console\Command\Command;
use Laventure\Component\Console\Command\Contract\CommandInterface;
use Laventure\Component\Console\Command\Contract\ListCommandInterface;
use Laventure\Component\Console\Input\Contract\InputInterface;
use Laventure\Component\Console\Output\Contract\OutputInterface;

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
        return $this->commands;
    }




    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int
    */
    public function execute(InputInterface $input, OutputInterface $output): int
    {
        echo "Usage: \n";

        foreach ($this->commands as $command) {
            echo "{$command->getName()} :  {$command->getDescription()}\n";
        }

        return Command::SUCCESS;
    }
}
