<?php

declare(strict_types=1);

namespace Laventure\Component\Console\Kernel;

use Laventure\Component\Console\Input\InputInterface;

/**
 * TerminateInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Console\ConsoleKernel
*/
interface TerminateInterface
{
    /**
     * Terminate execution
     *
     * @param InputInterface $input
     * @param $status
     * @return mixed|void
    */
    public function terminate(InputInterface $input, $status);
}
