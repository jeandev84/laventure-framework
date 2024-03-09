<?php

declare(strict_types=1);

namespace Laventure\Component\Console\Command\Contract;

/**
 * HasDefaultCommandInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Console\Command\Contract
*/
interface HasDefaultCommandInterface extends CommandInterface
{
    /**
     * @return string
    */
    public function getDefaultName(): string;
}
