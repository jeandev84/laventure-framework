<?php

declare(strict_types=1);

namespace Laventure\Foundation\Console\Commands\Migration;

use Laventure\Component\Console\Command\Command;
use Laventure\Component\Console\Input\InputInterface;
use Laventure\Component\Console\Output\OutputInterface;
use Laventure\Component\Database\Schema\Migrator\MigratorInterface;

/**
 * MigrationMigrateCommand
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Foundation\Console\Commands\Database\Schema\Migration
*/
class MigrationMigrateCommand extends Command
{
    /**
     * @var string
    */
    protected $name = 'migration:migrate';




    /**
     * @var array
    */
    protected array $description = [
        "Migrate all tables"
    ];





    /**
     * @param MigratorInterface $migrator
    */
    public function __construct(protected MigratorInterface $migrator)
    {
        parent::__construct($this->name);
    }



    /**
     * @inheritDoc
    */
    public function execute(InputInterface $input, OutputInterface $output): int
    {
        //TODO more correctly
        if ($this->migrator->migrate()) {
            $output->writeln("Migrated");
        } else {
            $output->info("All migrations already applied.");
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
