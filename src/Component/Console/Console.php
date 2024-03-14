<?php

declare(strict_types=1);

namespace Laventure\Component\Console;

use Laventure\Component\Console\Command\Collection\CommandCollectionInterface;
use Laventure\Component\Console\Command\Command;
use Laventure\Component\Console\Command\Contract\CommandInterface;
use Laventure\Component\Console\Command\Contract\ListCommandInterface;
use Laventure\Component\Console\Command\Defaults\DefaultListCommands;
use Laventure\Component\Console\Command\Exception\EmptyCommandNameException;
use Laventure\Component\Console\Input\InputInterface;
use Laventure\Component\Console\Input\Option\OptionStatusInterface;
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
class Console implements ConsoleInterface, CommandCollectionInterface, OptionStatusInterface
{
    /**
     * @var CommandInterface[]
    */
    protected array $commands = [];




    /**
     * @var ListCommandInterface
    */
    private ListCommandInterface $listCommand;



    /**
     * @throws EmptyCommandNameException
    */
    public function __construct()
    {
        $this->addListCommand(new DefaultListCommands());
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
     * @inheritDoc
     * @throws EmptyCommandNameException
    */
    public function addListCommand(ListCommandInterface $listCommand): static
    {
        $this->listCommand = $listCommand;

        return $this->addCommand($this->listCommand);
    }







    /**
     * @inheritDoc
    */
    public function getListCommand(): ListCommandInterface
    {
        $this->listCommand->withAvailableCommands($this->commands);

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

        $command = $this->setCommandDefaultOptions($command);
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
        $listCommand = $this->getListCommand();
        $matchedName = ($name === $listCommand->getName());

        if (!$this->hasCommand($name) || $matchedName) {
            return $listCommand;
        }

        return $this->commands[$name];
    }





    /**
     * @inheritDoc
    */
    public function run(InputInterface $input, OutputInterface $output): int
    {
        // find command
        $command = $this->getCommand($input->getFirstArgument());

        // display help
        foreach ($input->getOptions() as $name => $option) {
            if ($this->hasHelp($name)) {
                $output->printTableList($command->getHelpList());
                return Command::INFO;
            }
        }

        $status  = $command->run($input, $output);
        $output->print();
        return $status;
    }







    /**
     * @inheritDoc
    */
    public function hasVersion($name): bool
    {
        return $this->hasInputOption($name, ['version', 'V']);
    }




    /**
     * @inheritDoc
    */
    public function hasHelp($name): bool
    {
        return $this->hasInputOption($name, ['help', 'h']);
    }





    /**
     * @inheritDoc
    */
    public function hasQuiet($name): bool
    {
        return $this->hasInputOption($name, ['quiet', 'q']);
    }





    /**
     * @inheritDoc
    */
    public function hasNoInteraction($name): bool
    {
        return $this->hasInputOption($name, ['no-interaction', 'n']);
    }




    /**
     * @inheritDoc
    */
    public function hasEnvironment($name): bool
    {
        return $this->hasInputOption($name, ['env=ENV', 'e']);
    }




    /**
     * @inheritDoc
    */
    public function hasNoDebug($name): bool
    {
        return $this->hasInputOption($name, ['no-debug']);
    }





    /**
     * @inheritDoc
    */
    public function hasVerbose($name): bool
    {
        return $this->hasInputOption($name, ['verbose', 'v', 'vv', 'vvv']);
    }






    /**
     * @param $name
     * @param array $options
     * @return bool
    */
    private function hasInputOption($name, array $options): bool
    {
        return in_array($name, $options);
    }




    /**
     * @param CommandInterface $command
     * @return CommandInterface
    */
    private function setCommandDefaultOptions(CommandInterface $command): CommandInterface
    {
        foreach ($this->getDefaultOptions() as $options) {
            [$name, $description, $shortcut] = $options;
            $command->addOption($name, $description, $shortcut);
        }

        return $command;
    }




    /**
     * @return array[]
    */
    private function getDefaultOptions(): array
    {
        $listCommandName = $this->getListCommand()->getName();

        return [
            ["help",    "Display help for the given command. When no command is given display help for the ($listCommandName) command", "h"],
            ["quiet",   "Do not output any message", "q"],
            ["version", "Display this application version", "V"],
            /*[['ansi', 'no-ansi'], "Force (or disable --no-ansi) ANSI output", ''],*/
            ["no-interaction", 'Do not ask any interactive question', "n"],
            ["env=ENV", 'The Environment name. [default: "dev"]', "e"],
            ["no-debug", 'Switch off debug mode.', ''],
            ["verbose", 'Increase the verbosity of messages: 1 for normal output, 2 for more verbose output and 3 for debug', 'v|vv|vvv'],
        ];
    }
}
