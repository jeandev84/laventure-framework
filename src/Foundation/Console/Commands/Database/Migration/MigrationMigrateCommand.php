<?php

declare(strict_types=1);

namespace Laventure\Foundation\Console\Commands\Database\Migration;

use Laventure\Component\Console\Command\Command;
use Laventure\Component\Console\Input\InputInterface;
use Laventure\Component\Console\Output\OutputInterface;
use Laventure\Foundation\Loader\Migration\MigrationLoaderInterface;

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
     * @param MigrationLoaderInterface $migrationLoader
    */
    public function __construct(
        protected MigrationLoaderInterface $migrationLoader
    )
    {
        parent::__construct($this->name);
    }



    /**
     * @inheritDoc
    */
    public function execute(InputInterface $input, OutputInterface $output): int
    {
        dd($this->migrationLoader->load());
//        # dd($this->migrationLoader->getCollection()->getPaths());
//
//        $files = [];
//
//        foreach ($this->migrationLoader->getCollection()->getFiles() as $file) {
//            $files[] = $file->getPath();
//        }
//
//        dd($files);

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
