<?php

declare(strict_types=1);

namespace Laventure\Component\Database\Query\Builder\SQL\Commands;

use Stringable;

/**
 * GroupBy
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\Builder\SQL\Commands
 */
class GroupBy implements Stringable
{
    public function __construct(public array $groupBy)
    {
    }



    /**
     * @inheritDoc
    */
    public function __toString(): string
    {
        if (empty($this->groupBy)) {
            return '';
        }

        return sprintf('GROUP BY %s', join($this->groupBy));
    }
}
