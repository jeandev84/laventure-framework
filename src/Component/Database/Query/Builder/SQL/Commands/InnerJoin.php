<?php

declare(strict_types=1);

namespace Laventure\Component\Database\Query\Builder\SQL\Commands;

/**
 * InnerJoin
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\Statement\Builder\SQL\Commands
*/
class InnerJoin extends Join
{
    /**
     * @inheritDoc
    */
    public function __toString(): string
    {
        return "INNER JOIN $this->table ON $this->condition";
    }
}
