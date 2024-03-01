<?php

declare(strict_types=1);

namespace Laventure\Component\Database\Builder\SQL\Commands;

use Stringable;

/**
 * Delete
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\Builder\SQL\Commands
*/
class Delete implements Stringable
{
    /**
     * @param string $table
    */
    public function __construct(protected string $table)
    {
    }



    /**
     * @inheritDoc
    */
    public function __toString(): string
    {
        return sprintf('DELETE FROM %s', $this->table);
    }
}
