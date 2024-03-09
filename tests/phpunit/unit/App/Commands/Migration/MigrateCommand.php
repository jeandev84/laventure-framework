<?php
declare(strict_types=1);

namespace PHPUnitTest\App\Commands\Migration;

use Laventure\Component\Console\Command\Command;
use Laventure\Component\Console\Input\Contract\InputInterface;
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
      * @var array|string[]
     */
      protected array $description = [
        'This command used for migrate data tables to database'
      ];



      public function __construct()
      {
          parent::__construct('database:migrations:migrate');
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