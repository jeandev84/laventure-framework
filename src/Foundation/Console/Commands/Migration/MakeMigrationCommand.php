<?php

declare(strict_types=1);

namespace Laventure\Foundation\Console\Commands\Migration;

use Laventure\Component\Console\Command\Command;
use Laventure\Component\Console\Input\InputInterface;
use Laventure\Component\Console\Output\OutputInterface;
use Laventure\Foundation\Generator\Migration\Factory\MigrationFileGeneratorFactory;

/**
 * MakeMigrationCommand
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Foundation\Console\Commands\Migration
*/
class MakeMigrationCommand extends Command
{
    /**
     * @var string
     */
    protected $name = 'make:migration';




    /**
     * @var array
     */
    protected array $description = [
        "Creates new migration file."
    ];




    /**
     * @param MigrationFileGeneratorFactory $migrationFileGeneratorFactory
    */
    public function __construct(
        protected MigrationFileGeneratorFactory $migrationFileGeneratorFactory
    ) {
        parent::__construct($this->name);
    }





    /**
     * Example:
     *  e.g, php laventure make:migration --table=users  (by default generate relative current active ORM)
     *  e.g, php laventure make:migration --table=users --type=mapper
     *  e.g, php laventure make:migration --table=users --type=model
     *
     * @return void
    */
    protected function configure(): void
    {
        $this->addOption('table', "This option [ table|t ] specify the table name of migration file.)")
             #->shortcut('t') // TODO reviews for shortcut
             ->required();

        $this->addOption('type', "This option [ type=model ] specify the table name of migration file.)")
             ->optional();
    }





    /**
     * @inheritDoc
    */
    public function execute(InputInterface $input, OutputInterface $output): int
    {
        #$tableName = $input->getOption('table|t');
        $tableName = $input->getOption('table');
        $type      = $input->getOption('type');

        $generator = $this->migrationFileGeneratorFactory->createGenerator($tableName, $type);

        if ($generator->generate()) {
            $output->success("New migration file generated.");
            $output->success("Target path [{$generator->getTargetPath()}].");
        } else {
            $output->info("No file migration generated.");
        }

        return Command::SUCCESS;
    }





    /**
     * @return string[]
     */
    public function getUsage(): array
    {
        return ["$this->name [options]"];
    }
}
