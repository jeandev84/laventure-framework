<?php
declare(strict_types=1);

namespace Laventure\Component\Database\Connection\Extensions\PDO\Query\Builder\SQL\Criteria;

use Laventure\Component\Database\Query\Builder\SQL\Conditions\Criteria\Resolved\CriteriaResolved;
use Laventure\Component\Database\Query\Builder\SQL\Conditions\Criteria\Resolved\CriteriaResolvedInterface;
use Laventure\Component\Database\Query\Builder\SQL\Conditions\Criteria\Resolver\SQLCriteriaResolver;

/**
 * SQLCriteriaResolverPDO
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\Query\Builder\SQL\Criteria\PDO
 */
class SQLCriteriaResolverPDO extends SQLCriteriaResolver
{


    /**
     * @inheritdoc
    */
    public function resolveWhereIn($column, array $value): CriteriaResolvedInterface
    {
        $bindParam   = $this->resolveBindingColumn($column);
        return new CriteriaResolved(
            $this->builder->expr()->in($column, ":$bindParam"),
            $column,
            $value
        );
    }




    /**
     * @inheritdoc
    */
    public function resolveWhereEqualTo($column, $value): CriteriaResolvedInterface
    {
        $bindParam = $this->resolveBindingColumn($column);
        return new CriteriaResolved(
            $this->builder->expr()->eq($column, ":$bindParam"),
            $column,
            $value
        );
    }





    /**
     * @param string $column
     * @return string
    */
    private function resolveBindingColumn(string $column): string
    {
        return str_replace(['.'], ['_'], $column);
    }
}