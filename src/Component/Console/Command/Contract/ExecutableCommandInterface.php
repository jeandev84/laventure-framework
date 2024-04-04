<?php

declare(strict_types=1);

namespace Laventure\Component\Console\Command\Contract;

use Laventure\Component\Console\Input\InputInterface;
use Laventure\Component\Console\Output\OutputInterface;

/**
 * ExecutableCommandInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Console\Command\Contract
*/
interface ExecutableCommandInterface
{
    /**
     * Execute command
     *
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int
    */
    public function execute(InputInterface $input, OutputInterface $output): int;
}
