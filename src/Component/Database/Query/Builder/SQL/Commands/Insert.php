<?php

declare(strict_types=1);

namespace Laventure\Component\Database\Query\Builder\SQL\Commands;

use Stringable;

/**
 * Insert
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\Builder\SQL\Commands
*/
class Insert implements Stringable
{
    /**
     * @param string $table
     * @param array $columns
     * @param array $values
    */
    public function __construct(
        public string $table,
        public array $columns,
        public array $values
    ) {
    }




    /**
     * @inheritDoc
    */
    public function __toString(): string
    {
        return sprintf("INSERT INTO %s (%s)",
            $this->table,
            $this->columns()
        );
    }






    /**
     * @return string
    */
    private function columns(): string
    {
        return join(', ', $this->columns);
    }
}
