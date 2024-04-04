<?php

declare(strict_types=1);

namespace Laventure\Component\Database\Query\Builder\SQL\Commands;

use Laventure\Component\Database\Query\Builder\SQL\Conditions\SQLConditionBuilder;
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
     * @var SQLConditionBuilder
    */
    protected SQLConditionBuilder $conditions;



    /**
     * @param array $having
    */
    public function __construct(array $having)
    {
        $this->conditions = new SQLConditionBuilder($having);
    }




    /**
     * @inheritDoc
    */
    public function __toString(): string
    {
        if ($this->conditions->empty()) {
            return '';
        }

        return sprintf('HAVING %s', $this->conditions->build());
    }
}
