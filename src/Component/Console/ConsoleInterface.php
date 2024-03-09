<?php

declare(strict_types=1);

namespace Laventure\Component\Console;

use Laventure\Component\Console\Command\Contract\CommandInterface;
use Laventure\Component\Console\Command\Contract\HelpCommandInterface;
use Laventure\Component\Console\Command\Contract\ListCommandInterface;
use Laventure\Component\Console\Input\Contract\InputInterface;
use Laventure\Component\Console\Output\Contract\OutputInterface;

/**
 * ConsoleInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Console
*/
interface ConsoleInterface
{
    /**
     * @return ListCommandInterface
     */
    public function getListCommand(): ListCommandInterface;





    /**
     * @return HelpCommandInterface
     */
    public function getHelpCommand(): HelpCommandInterface;



    /**
     * @return CommandInterface[]
    */
    public function getCommands(): array;





    /**
     * @param $name
     * @return bool
    */
    public function hasCommand($name): bool;






    /**
     * Returns command to execute
     *
     * @param $name
     * @return CommandInterface
    */
    public function getCommand($name): CommandInterface;







    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int
    */
    public function run(InputInterface $input, OutputInterface $output): int;
}
