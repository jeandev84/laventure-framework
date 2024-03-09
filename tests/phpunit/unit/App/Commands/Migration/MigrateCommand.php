<?php
declare(strict_types=1);

namespace PHPUnitTest\App\Commands\Migration;

use Laventure\Component\Console\Command\Command;
use Laventure\Component\Console\Input\Argument\InputArgument;
use Laventure\Component\Console\Input\Contract\InputInterface;
use Laventure\Component\Console\Input\Option\InputOption;
use Laventure\Component\Console\Output\Contract\OutputInterface;

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
          $this->addArgument('path', 'Indicate path of migrations', '', [
                    InputArgument::REQUIRED
               ])
               ->addOption('table', 'Indicate current table to migrate', 't', [
                   InputOption::REQUIRED
               ])
               ->addOption('refresh', 'Refresh migrations', 'r', [
                   InputOption::OPTIONAL
               ])
               ->addOption('force', 'Force migrations', 'f');
      }






      /**
       * @param InputInterface $input
       * @param OutputInterface $output
       * @return int
      */
      public function execute(InputInterface $input, OutputInterface $output): int
      {
         $output->writeln("Processing migrate to the database ...");
         return Command::SUCCESS;
      }
}