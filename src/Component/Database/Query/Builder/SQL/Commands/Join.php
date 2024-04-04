<?php

declare(strict_types=1);

namespace Laventure\Component\Database\Query\Builder\SQL\Commands;

use Stringable;

/**
 * Join
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\Statement\Builder\SQL\Commands
*/
class Join implements Stringable
{
    /**
     * @param string $table
     * @param string $condition
    */
    public function __construct(protected string $table, protected string $condition)
    {
    }



    /**
     * @inheritDoc
    */
    public function __toString(): string
    {
        return "JOIN $this->table ON $this->condition";
    }


    /**
     * @return string
    */
    public function getTable(): string
    {
        return $this->table;
    }


    /**
     * @return string
    */
    public function getCondition(): string
    {
        return $this->condition;
    }
}
