<?php

declare(strict_types=1);

namespace Laventure\Component\Database\Query\Builder\SQL\Null;

use Laventure\Component\Database\Query\Builder\QueryBuilder;


/**
 * NullSQLQueryBuilder
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\Builder
*/
class NullSQLQueryBuilder extends QueryBuilder
{

    /**
     * @inheritDoc
     */
    protected function addMultipleInsert(array $values): static
    {
        return $this;
    }

    /**
     * @inheritDoc
    */
    protected function addInsert(array $attributes): static
    {
        return $this;
    }
}
