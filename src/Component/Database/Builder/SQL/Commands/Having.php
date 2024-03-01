<?php

declare(strict_types=1);

namespace Laventure\Component\Database\Builder\SQL\Commands;

use Stringable;

/**
 * Having
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\Builder\SQL\Commands
*/
class Having implements Stringable
{
    /**
     * @param array $having
    */
    public function __construct(public array $having)
    {
    }




    /**
     * @inheritDoc
    */
    public function __toString(): string
    {
        if (!$this->having) {
            return '';
        }

        return sprintf('HAVING %s', join($this->having));
    }
}
