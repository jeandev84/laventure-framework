<?php

declare(strict_types=1);

namespace Laventure\Component\Console\Kernel;

use Laventure\Component\Console\Input\InputInterface;
use Laventure\Component\Console\Output\OutputInterface;

/**
 * ConsoleKernelInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Console\ConsoleKernel
*/
interface ConsoleKernelInterface extends TerminateInterface
{
    /**
     * Console ConsoleKernel handle
     *
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return mixed
    */
    public function handle(InputInterface $input, OutputInterface $output): mixed;
}
