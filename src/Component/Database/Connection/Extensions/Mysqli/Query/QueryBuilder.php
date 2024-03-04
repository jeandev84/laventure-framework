<?php

declare(strict_types=1);

namespace Laventure\Component\Database\Connection\Extensions\Mysqli\Query;

use Laventure\Component\Database\Connection\Query\Builder\Common\AbstractQueryBuilder;

/**
 * QueryBuilder
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\Connection\Extensions\Mysqli\Query
*/
class QueryBuilder extends AbstractQueryBuilder
{
    /**
     * @inheritDoc
    */
    protected function resolveMultipleInsert(int $position, array $attributes): static
    {

    }




    /**
     * @inheritDoc
    */
    protected function resolveInsert(array $values): static
    {

    }



    /**
     * @inheritDoc
    */
    protected function resolveCriteria(string $column, $value): array
    {

    }
}
