<?php

declare(strict_types=1);

namespace Laventure\Component\Database\Query\Builder\SQL\Commands;

use Stringable;

/**
 * Limit
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\Statement\Builder\SQL\Commands
*/
class Limit implements Stringable
{
    /**
     * @param $limit
     * @param $offset
    */
    public function __construct(public $limit, public $offset = null)
    {
    }




    /**
     * @inheritDoc
    */
    public function __toString(): string
    {
        if (! $this->limit) {
            return '';
        }

        $limit = "LIMIT $this->limit";

        if (is_int($this->offset)) {
            $limit = "$limit OFFSET $this->offset";
        }

        return $limit;
    }
}
