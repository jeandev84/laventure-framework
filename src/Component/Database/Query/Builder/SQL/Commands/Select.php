<?php

declare(strict_types=1);

namespace Laventure\Component\Database\Query\Builder\SQL\Commands;

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
     * @param string $suffix
    */
    public function __construct(
        protected array $columns,
        protected string $suffix = ''
    ) {
    }



    /**
     * @inheritDoc
    */
    public function __toString(): string
    {
        $selects = $this->resolveSelects();

        if ($this->suffix) {
            $selects = "$this->suffix $selects";
        }

        return "SELECT $selects";
    }





    /**
     * @return string
    */
    private function resolveSelects(): string
    {
         $this->columns = array_filter($this->columns);

         if (empty($this->columns)) {
             return "*";
         }

         return join(', ', $this->columns);
    }
}
