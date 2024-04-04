<?php

declare(strict_types=1);

namespace Laventure\Component\Console\Command\Contract;

/**
 * ShellCommandInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Console\Command\Contract
*/
interface ShellCommandInterface extends CommandInterface
{
    /**
     * @param $command
     * @return mixed
    */
    public function shellExec($command): mixed;
}
