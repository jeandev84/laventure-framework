<?php

declare(strict_types=1);

namespace Laventure\Component\Console;

use Laventure\Component\Console\Command\Contract\CommandInterface;
use Laventure\Component\Console\Command\Contract\HelpCommandInterface;
use Laventure\Component\Console\Command\Contract\ListCommandInterface;
use Laventure\Component\Console\Command\Defaults\HelpCommand;
use Laventure\Component\Console\Command\Defaults\ListCommand;
use Laventure\Component\Console\Command\Exception\EmptyCommandNameException;
use Laventure\Component\Console\Input\Contract\InputInterface;
use Laventure\Component\Console\Output\Contract\OutputInterface;

/**
 * Console
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Console
 */
class Console implements ConsoleInterface
{
    /**
     * @var CommandInterface[]
    */
    protected array $commands = [];




    /**
     * @param array $commands
     * @throws EmptyCommandNameException
    */
    public function __construct(array $commands = [])
    {
        $this->addCommands($commands);
    }




    /**
     * @inheritDoc
    */
    public function getListCommand(): ListCommandInterface
    {
        return new ListCommand($this->getCommands());
    }




    /**
     * @inheritDoc
    */
    public function getHelpCommand(): HelpCommandInterface
    {
        return new HelpCommand();
    }





    /**
     * @inheritDoc
    */
    public function getCommands(): array
    {
        return $this->commands;
    }




    /**
     * @param CommandInterface $command
     * @return $this
     * @throws EmptyCommandNameException
    */
    public function addCommand(CommandInterface $command): static
    {
        if(!$name = $command->getName()) {
            throw new EmptyCommandNameException(get_class($command));
        }

        $this->commands[$name] = $command;

        return $this;
    }





    /**
     * @param CommandInterface[] $commands
     * @return $this
     * @throws EmptyCommandNameException
    */
    public function addCommands(array $commands): static
    {
        foreach ($commands as $command) {
            $this->addCommand($command);
        }

        return $this;
    }





    /**
     * @inheritDoc
    */
    public function hasCommand($name): bool
    {
        return isset($this->commands[$name]);
    }





    /**
     * @inheritDoc
    */
    public function getCommand($name): CommandInterface
    {
        $defaultCommand = $this->getListCommand();
        $matchNames     = ($name === $defaultCommand->getName());

        if (!$this->hasCommand($name) || $matchNames) {
            return $defaultCommand;
        }

        return $this->commands[$name];
    }





    /**
     * @inheritDoc
    */
    public function run(InputInterface $input, OutputInterface $output): int
    {
         $command = $this->getCommand($input->getFirstArgument());
         $status  = $command->run($input, $output);
         $output->print();
         return $status;
    }

}
