<?php
declare(strict_types=1);

namespace Laventure\Component\Database\Builder\SQL\Expr;


use Stringable;

/**
 * Limit
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\Builder\SQL\DQL\Expr
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

        return ($this->offset ? "$limit OFFSET $this->offset" : $limit);
    }
}
