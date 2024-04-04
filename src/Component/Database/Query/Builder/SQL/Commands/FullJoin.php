<?php

declare(strict_types=1);

namespace Laventure\Component\Database\Query\Builder\SQL\Commands;

/**
 * FullJoin
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\Statement\Builder\SQL\Commands
*/
class FullJoin extends Join
{
    /**
     * @inheritDoc
    */
    public function __toString(): string
    {
        return "FULL JOIN $this->table ON $this->condition";
    }
}
