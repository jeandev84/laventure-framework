<?php

declare(strict_types=1);

namespace Laventure\Component\Console;

use Laventure\Component\Console\Command\Contract\CommandInterface;
use Laventure\Component\Console\Command\Contract\HelpCommandInterface;
use Laventure\Component\Console\Command\Contract\ListCommandInterface;
use Laventure\Component\Console\Command\Contract\OptionCommandInterface;
use Laventure\Component\Console\Command\Usage\UsageCommandInterface;
use Laventure\Component\Console\Input\InputInterface;
use Laventure\Component\Console\Output\OutputInterface;

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
     * Return the php_sapi_name() for example
     *
     * @return mixed
    */
    public function getInteractive(): mixed;






    /**
     * Determine mode interaction cli or STDOUT ...
     *
     *
     * @return bool
    */
    public function isInteractive(): bool;







    /**
     * @param ListCommandInterface $listCommand
     * @return $this
    */
    public function addListCommand(ListCommandInterface $listCommand): static;







    /**
     * @return ListCommandInterface
    */
    public function getListCommand(): ListCommandInterface;







    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int
    */
    public function run(InputInterface $input, OutputInterface $output): int;
}
