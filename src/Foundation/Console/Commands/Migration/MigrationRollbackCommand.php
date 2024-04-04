<?php

declare(strict_types=1);

namespace Laventure\Foundation\Console\Commands\Migration;

use Laventure\Component\Console\Command\Command;
use Laventure\Component\Console\Input\InputInterface;
use Laventure\Component\Console\Output\OutputInterface;
use Laventure\Component\Database\Schema\Migrator\MigratorInterface;

/**
 * MigrationRollbackCommand
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Foundation\Console\Commands\Database\Migration
*/
class MigrationRollbackCommand extends Command
{
    /**
     * @var string
    */
    protected $name = 'migration:rollback';




    /**
     * @var array
    */
    protected array $description = [
        "Drop all tables without version table."
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
        if ($this->migrator->rollback()) {
            $output->writeln("Rollback migrations.");
        } else {
            $output->info("All migrations already removed.");
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
