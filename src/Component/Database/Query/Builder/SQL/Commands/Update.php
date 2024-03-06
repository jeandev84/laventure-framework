<?php

declare(strict_types=1);

namespace Laventure\Component\Database\Query\Builder\SQL\Commands;

use Stringable;

/**
 * PgsqlUpdateBuilder
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\Builder\SQL\Commands
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
