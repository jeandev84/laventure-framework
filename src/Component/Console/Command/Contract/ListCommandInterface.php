<?php

declare(strict_types=1);

namespace Laventure\Component\Console\Command\Contract;

/**
 * ListCommandInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Console\Command\Contract
*/
interface ListCommandInterface extends CommandInterface
{
    /**
     * @return CommandInterface[]
    */
    public function getCommands(): array;
}
