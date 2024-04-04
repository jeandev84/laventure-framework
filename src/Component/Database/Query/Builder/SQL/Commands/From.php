<?php

declare(strict_types=1);

namespace Laventure\Component\Database\Query\Builder\SQL\Commands;

use Stringable;

/**
 * From
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\Builder\SQL\Commands
 */
class From implements Stringable
{
    /**
     * @param array $from
    */
    public function __construct(public array $from)
    {
    }



    /**
     * @inheritDoc
    */
    public function __toString(): string
    {
        return "FROM ". join(', ', array_values($this->from));
    }
}
