<?php
declare(strict_types=1);

namespace Laventure\Component\Console;

use Laventure\Component\Console\Command\Collection\CommandCollectionInterface;
use Laventure\Component\Console\Command\Contract\CommandInterface;
use Laventure\Component\Console\Command\Contract\ListCommandInterface;
use Laventure\Component\Console\Command\Contract\OptionCommandInterface;
use Laventure\Component\Console\Command\List\ListCommand;
use Laventure\Component\Console\Command\Exception\EmptyCommandNameException;
use Laventure\Component\Console\Command\Usage\UsageCommandInterface;
use Laventure\Component\Console\Input\InputInterface;
use Laventure\Component\Console\Output\OutputInterface;

/**
 * Console
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Console
*/
class Console implements ConsoleInterface, CommandCollectionInterface
{

    /**
     * @var CommandInterface[]
    */
    protected array $commands = [];




    /**
     * @var ListCommandInterface
    */
    protected ListCommandInterface $listCommand;




    public function __construct()
    {
         $this->listCommand = new ListCommand();
    }




    /**
     * @inheritDoc
     */
    public function getInteractive(): false|string
    {
        return php_sapi_name();
    }






    /**
     * @inheritDoc
    */
    public function isInteractive(): bool
    {
        $interactive = $this->getInteractive();

        return ($interactive === 'cli' || $interactive === 'phpdbg');
    }





    /**
     * @param array $optionCommands
     * @return $this
    */
    public function addOptionCommands(array $optionCommands): static
    {
         $this->listCommand->withOptions($optionCommands);

         return $this;
    }






    /**
     * @inheritDoc
    */
    public function getListCommand(): ListCommandInterface
    {
        return $this->listCommand;
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
