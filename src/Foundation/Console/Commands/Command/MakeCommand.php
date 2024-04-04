<?php

declare(strict_types=1);

namespace Laventure\Foundation\Console\Commands\Command;

use Laventure\Component\Console\Command\Command;
use Laventure\Component\Console\Command\Exception\CommandException;
use Laventure\Component\Console\Command\Resolver\CommandNameResolver;
use Laventure\Component\Console\Input\InputInterface;
use Laventure\Component\Console\Output\OutputInterface;
use Laventure\Foundation\Generator\Command\CommandGenerator;
use Laventure\Foundation\Generator\Command\Exception\CommandGeneratorException;

/**
 * MakeCommand
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Foundation\Console\Commands\Command
*/
class MakeCommand extends Command
{
    /**
     * @var string
    */
    protected $name = 'make:command';


    /**
     * @var array|string[]
    */
    protected array $description = [
        'make:command permit to create a new command.'
    ];





    /**
     * @param CommandGenerator $commandGenerator
    */
    public function __construct(protected CommandGenerator $commandGenerator)
    {
        parent::__construct($this->name);
    }





    /**
     * @inheritDoc
    */
    protected function configure(): void
    {
        $this->addArgument('name', "Choose a command name (e.g. app:foo-command)")
             ->required();
    }


    /**
     * @inheritDoc
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int
     */
    public function execute(InputInterface $input, OutputInterface $output): int
    {
        $this->commandGenerator->withCommand($commandName = $input->getArgument('name'));

        if (!$this->commandGenerator->generated()) {
            if ($this->commandGenerator->generate()) {
                $output->success("Command [ $commandName ] successfully generated.");
                $output->success("Generated path '{$this->getTargetPath()}' successfully generated.");
            }
        } else {
            $output->info("Command [ $commandName ] already exists.");
            $output->info("Target path '{$this->getTargetPath()}'");
        }

        return Command::SUCCESS;
    }





    /**
     * @inheritDoc
    */
    public function getUsage(): array
    {
        return ["{$this->getName()} [<name>]"];
    }




    /**
     * @return string
    */
    private function getTargetPath(): string
    {
        return $this->commandGenerator->getTargetPath();
    }
}
