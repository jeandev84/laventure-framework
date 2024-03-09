<?php
declare(strict_types=1);

namespace PHPUnitTest\App\Commands;

use Laventure\Component\Console\Command\Command;
use Laventure\Component\Console\Input\Contract\InputInterface;
use Laventure\Component\Console\Output\Contract\OutputInterface;

/**
 * HelloCommand
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  PHPUnitTest\App\Commands
 */
class HelloCommand extends Command
{

    /**
     * @var string
    */
    protected string $defaultName = 'hello';



    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int
    */
    public function execute(InputInterface $input, OutputInterface $output): int
    {
         echo "Hello! Friends.\n";
         return Command::SUCCESS;
    }
}