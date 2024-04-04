<?php

declare(strict_types=1);

namespace Laventure\Component\Database\Query\Builder\SQL\Commands;

use Stringable;

/**
 * Set
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\Statement\Builder\SQL\Commands\Set
 */
class Set implements Stringable
{
    /**
     * @param array $set
    */
    public function __construct(public array $set)
    {
    }


    /**
     * @inheritDoc
    */
    public function __toString(): string
    {
        return sprintf('SET %s', join(', ', $this->set));
    }
}
