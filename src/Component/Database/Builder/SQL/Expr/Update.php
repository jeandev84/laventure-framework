<?php

declare(strict_types=1);

namespace Laventure\Component\Database\Builder\SQL\Expr;

use Stringable;

/**
 * Update
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\Builder\SQL\Expr
*/
class Update implements Stringable
{
    /**
     * @param string $table
    */
    public function __construct(public string $table)
    {
    }




    /**
     * @inheritDoc
     */
    public function __toString()
    {
        return sprintf("UPDATE %s", $this->table);
    }
}
