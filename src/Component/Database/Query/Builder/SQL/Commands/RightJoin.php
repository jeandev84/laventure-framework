<?php

declare(strict_types=1);

namespace Laventure\Component\Database\Query\Builder\SQL\Commands;

/**
 * RightJoin
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\Statement\Builder\SQL\Commands
*/
class RightJoin extends Join
{
    /**
     * @inheritDoc
    */
    public function __toString(): string
    {
        return "RIGHT JOIN $this->table ON $this->condition";
    }
}
