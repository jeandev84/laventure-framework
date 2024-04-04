<?php

declare(strict_types=1);

namespace Laventure\Component\Database\Query\Builder\SQL\Commands;

use Stringable;

/**
 * Values
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\Statement\Builder\SQL\Commands
*/
class Values implements Stringable
{
    /**
     * @param array $values
    */
    public function __construct(public array $values)
    {
    }



    /**
     * @inheritDoc
    */
    public function __toString(): string
    {
        return sprintf("VALUES %s", $this->values());
    }





    /**
     * @return string
    */
    private function values(): string
    {
        $format = [];

        foreach ($this->values as $values) {
            $format[] = '('. join(', ', array_values($values)) . ')';
        }

        return join(', ', $format);
    }
}
