<?php

declare(strict_types=1);

namespace PHPUnitTest\App\Commands;

use Laventure\Component\Console\Command\Command;
use Laventure\Component\Console\Input\InputInterface;
use Laventure\Component\Console\Output\OutputInterface;

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
    protected $name = 'hello';


    protected array $description = [
        'This command used to say hello users. Thanks you!'
    ];


    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int
    */
    public function execute(InputInterface $input, OutputInterface $output): int
    {
        $output->writeln("Hello! Friends.");
        return Command::SUCCESS;
    }
}
