<?php

declare(strict_types=1);

namespace Laventure\Foundation\Console\Commands\Migration;

use Laventure\Component\Console\Command\Command;
use Laventure\Component\Console\Input\InputInterface;
use Laventure\Component\Console\Output\OutputInterface;
use Laventure\Component\Database\Schema\Migrator\MigratorInterface;

/**
 * MigrationInstallCommand
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Foundation\Console\Commands\Database\Schema\Migration
*/
class MigrationInstallCommand extends Command
{
    /**
     * @var string
    */
    protected $name = 'migration:install';




    /**
     * @var array
    */
    protected array $description = [
        "This command permit to create migrations version table"
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
        $tableName     = $this->migrator->getTable();
        $databaseName  = $this->migrator->getConnection()->getDatabaseName();

        #dd($tableName, $databaseName);

        if (!$this->migrator->installed()) {
            if ($this->migrator->install()) {
                $output->info("Migration version table [$tableName] installed in database [$databaseName]");
            }
        } else {
            $output->info("Table [$tableName] of database [$databaseName] already installed!");
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
