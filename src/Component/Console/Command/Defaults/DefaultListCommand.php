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
        $table = new ConsoleTable();

        $output->writeln("Usage:");

        foreach ($this->getUsage() as $usage) {
            $output->writeln("\x20$usage");
        }

        $output->writeln('');
        $output->writeln("Options:");

        foreach ($this->getOptionsDescription() as $option) {
            $output->writeln("\x20$option");
        }

        $output->writeln('');
        $output->writeln("Available commands:");
        [$defaultCommands, $namedCommands] = $this->getListAvailableCommands();

        foreach ($defaultCommands as $command => $description) {
            $table->addRow(["\x20$command", $description ?: 'No description.']);
        }

        foreach ($namedCommands as $groupName => $namedCommand) {
            $table->addRow([$groupName, '']);
            foreach ($namedCommand as $command => $description) {
                $table->addRow([$command, $description]);
            }
        }

        $table->hideBorder();
        $output->writeln($table->getTable());

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
     * @inheritDoc
    */
    public function getOptionsDescription(): array
    {
        return [
            "-h, --help               Display help for the given command. When no command is given display help for the ($this->name) command",
            '-q, --quiet              Do not output any message',
            '-V, --version            Display this application version',
            '    --ansi|--no-ansi     Force (or disable --no-ansi) ANSI output',
            '-n, --no-interaction     Do not ask any interactive question',
            '-e, --env=ENV            The Environment name. [default: "dev"]',
            '    --no-debug           Switch off debug mode.',
            '-v|vv|vvv, --verbose     Increase the verbosity of messages: 1 for normal output, 2 for more verbose output and 3 for debug'
        ];
    }




    /**
     * @return array
    */
    private function getListAvailableCommands(): array
    {
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
    }
}
