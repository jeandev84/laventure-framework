<?php

declare(strict_types=1);

namespace Laventure\Component\Database\Query\Builder\SQL\Commands;

use Laventure\Component\Database\Query\Builder\SQL\Conditions\SQLCondition;
use Stringable;

/**
 * Where
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\Builder\SQL\Where\Expr
*/
class Where implements Stringable
{
    /**
     * @var SQLCondition
    */
    protected SQLCondition $conditions;



    /**
     * @param array $wheres
    */
    public function __construct(array $wheres)
    {
        $this->conditions = new SQLCondition($wheres);
    }



    /**
     * @inheritDoc
    */
    public function __toString(): string
    {
        if (! $this->conditions->empty()) {
            return '';
        }

        return sprintf('WHERE %s', $this->conditions->build());
    }
}
