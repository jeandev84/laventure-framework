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
     * @var array
    */
    protected array $columns;


    /**
     * @var string|null
    */
    protected ?string $prefix;



    /**
     * @param array $columns
     * @param $prefix
    */
    public function __construct(array $columns, $prefix = null) {
        $this->columns  = $columns;
        $this->prefix   = $prefix;
    }



    /**
     * @inheritDoc
    */
    public function __toString(): string
    {
        $selects = $this->resolveSelects($this->columns);

        if ($this->prefix) {
            $selects = "$this->prefix $selects";
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
