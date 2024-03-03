<?php

declare(strict_types=1);

namespace Laventure\Component\Database\Query\Builder\SQL\Commands;

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
     * @var array
    */
    protected array $wheres = [];



    /**
     * @param array $wheres
    */
    public function __construct(array $wheres)
    {
        $this->wheres = $wheres;
    }



    /**
     * @inheritDoc
    */
    public function __toString(): string
    {
        if (! $this->wheres) {
            return '';
        }

        return sprintf('WHERE %s', join(' ', $this->wheres));
    }
}
