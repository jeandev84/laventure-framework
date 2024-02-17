<?php

declare(strict_types=1);

namespace Laventure\Component\Database\Builder\SQL\Expr;

use Stringable;

/**
 * Selected
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\Builder\SQL\Expr
*/
class Select implements Stringable
{

    protected bool $distinct = false;


    /**
     * @param string $columns
    */
    public function __construct(public string $columns)
    {

    }



    /**
     * @inheritDoc
    */
    public function __toString(): string
    {
        return "SELECT $this->columns";
    }
}
