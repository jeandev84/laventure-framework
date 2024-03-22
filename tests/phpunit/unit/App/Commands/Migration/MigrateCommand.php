<?php

declare(strict_types=1);

namespace PHPUnitTest\App\Commands\Migration;

use Laventure\Component\Console\Command\Command;
use Laventure\Component\Console\Input\InputInterface;
use Laventure\Component\Console\Output\OutputInterface;

/**
 * MigrateCommand
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  PHPUnitTest\App\Commands\Migration
*/
class MigrateCommand extends Command
{
    /**
     * @var string
    */
    protected $name = 'database:migrations:migrate';



    /**
     * @var array|string[]
    */
    protected array $description = [
       'This command used for migrate data tables to database'
    ];





    /**
     * $ php console
     *       database:migrations:migrate
     *       create_new_users_table path='/database/migrations/' -table=users --refresh=users -t --r --force
     *
     * @return void
    */
    public function configure(): void
    {
        /*
        $this->argument('path', 'Indicate path of migrations')
             ->rules([InputArgument::REQUIRED]);

        $this->option('table', 'Indicate current table to migrate', 't')
             ->rules([InputOption::REQUIRED]);

        $this->option('refresh', 'Refresh migrations', 'r')
             ->rules([InputOption::OPTIONAL]);

        $this->option('force', 'Force migrations', 'f');
        */

    }






    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int
    */
    public function execute(InputInterface $input, OutputInterface $output): int
    {
        /*
        $argument = $input->getArgument();
        dump('Argument0', $argument);
        dump('-|--Options', $input->getOptions());
        dump('--force', $input->getOption('force'));
        */

        $output->writeln("Processing migrate to the database ...");

        return Command::SUCCESS;
    }




    /**
     * @inheritDoc
    */
    public function getUsage(): array
    {
        return ["{$this->getName()} [options] [arguments]"];
    }
}
