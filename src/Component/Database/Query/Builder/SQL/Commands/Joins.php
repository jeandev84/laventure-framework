<?php

declare(strict_types=1);

namespace Laventure\Component\Database\Query\Builder\SQL\Commands;

use Stringable;

/**
 * Joins
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\Builder\SQL\DQL\Expr\Joins
*/
class Joins implements Stringable
{
    /**
     * @param array $joins
    */
    public function __construct(public array $joins)
    {
    }



    /**
     * @inheritDoc
    */
    public function __toString(): string
    {
        return ($this->joins ? join(' ', $this->joins) : '');
    }
}
