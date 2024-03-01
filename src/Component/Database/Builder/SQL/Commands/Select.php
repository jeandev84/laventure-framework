<?php

declare(strict_types=1);

namespace Laventure\Component\Database\Builder\SQL\Commands;

use Stringable;

/**
 * Selected
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\Builder\SQL\Commands
*/
class Select implements Stringable
{
    /**
     * @param array $columns
     * @param bool $distinct
    */
    public function __construct(
        public array $columns,
        public bool $distinct = false
    ) {

    }



    /**
     * @inheritDoc
    */
    public function __toString(): string
    {
        $selects  =  join(', ', array_filter($this->columns));
        $selects  =  !empty($this->columns) ? $selects : "*";
        $selects  =  $this->distinct ? "DISTINCT $selects" : $selects;

        return "SELECT $selects";
    }
}
