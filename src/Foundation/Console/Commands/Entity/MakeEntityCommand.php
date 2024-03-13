<?php

declare(strict_types=1);

namespace Laventure\Foundation\Console\Commands\Entity;

use Laventure\Component\Console\Command\Command;
use Laventure\Component\Console\Input\InputInterface;
use Laventure\Component\Console\Output\OutputInterface;
use Laventure\Foundation\Generator\Entity\EntityGenerator;
use Laventure\Foundation\Generator\Entity\EntityGeneratorInterface;

/**
 * MakeEntityCommand
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Foundation\Console\Commands\Entity
 */
class MakeEntityCommand extends Command
{
    /**
     * @var string
    */
    protected $name = 'make:entity';




    /**
     * @var array
     */
    protected array $description = [
        "Creates a new entity for mapping data from database."
    ];



    /**
     * @param EntityGenerator $entityGenerator
    */
    public function __construct(protected EntityGenerator $entityGenerator)
    {
        parent::__construct($this->name);
    }




    /**
     * @return void
     */
    protected function configure(): void
    {
        $this->addArgument('name', "Choose a entity name (e.g. Books/Book or User)")
             ->required();
    }





    /**
     * @inheritDoc
    */
    public function execute(InputInterface $input, OutputInterface $output): int
    {
        # Check resource classname we want to create that must be entity
        # (e.g, Book|User ...)
        $entity = $input->getArgument('name');

        # generate entity
        $this->entityGenerator->withClassName($entity);

        if (!$this->entityGenerator->generated()) {
            if($this->entityGenerator->generate()) {
                $output->success("New entity [$entity] successfully generated.");
                $output->success("Entity path is <{$this->entityGenerator->getTargetPath()}>.");
                $output->success("Repository path is <{$this->entityGenerator->getRepositoryPath()}>.");
            }
        } else {
            $output->success("Entity [{$entity}] already exists.");
            $output->success("Path '{$this->entityGenerator->getTargetPath()}'.");
        }

        return Command::SUCCESS;
    }





    /**
     * @return string[]
    */
    public function getUsage(): array
    {
        return ["{$this->getName()} [<name>] [options]"];
    }
}
