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
        $selects = $this->resolveSelects($this->columns);

        if ($this->suffix) {
            $selects = "$this->suffix $selects";
        }

        return "SELECT $selects";
    }




    /**
     * @param array $columns
     * @return string
    */
    private function resolveSelects(array $columns): string
    {
        if (empty($columns)) {
            return "*";
        }

        return join(', ', array_filter($columns));
    }
}
