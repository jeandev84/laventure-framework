<?php

declare(strict_types=1);

namespace Laventure\Component\Database\Builder\SQL\Expr;

use Stringable;

/**
 * Join
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\Builder\SQL\DQL\Expr\Join
*/
class Join implements Stringable
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
