<?php

declare(strict_types=1);

namespace Laventure\Component\Database\Query\Builder\SQL\Conditions\Criteria\Resolver;

use Laventure\Component\Database\Query\Builder\SQL\Conditions\Criteria\Resolved\CriteriaResolved;
use Laventure\Component\Database\Query\Builder\SQL\Conditions\Criteria\Resolved\CriteriaResolvedInterface;
use Laventure\Component\Database\Query\Builder\SQL\SQLBuilder;
use Laventure\Component\Database\Query\Builder\SQL\SQLBuilderInterface;

/**
 * SQLCriteriaResolver
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\Statement\Builder\SQL\Conditions\Criteria
*/
class SQLCriteriaResolver implements SQLCriteriaResolverInterface
{
    /**
     * @param SQLBuilder $builder
    */
    public function __construct(protected SQLBuilderInterface $builder)
    {
    }



    /**
     * @inheritDoc
    */
    public function resolveWhereIn($column, array $value): CriteriaResolvedInterface
    {
        return new CriteriaResolved(
            $this->builder->expr()->in($column, $value),
            $column,
            $value
        );
    }






    /**
     * @inheritDoc
    */
    public function resolveWhereEqualTo($column, $value): CriteriaResolvedInterface
    {
        return new CriteriaResolved(
            $this->builder->expr()->eq($column, $value),
            $column,
            $value
        );
    }
}
