<?php
declare(strict_types=1);

namespace Laventure\Component\Database\Connection\Query\Builder\SQL\Criteria\PDO;

use Laventure\Component\Database\Connection\Query\Builder\SQL\Criteria\CriteriaResolved;
use Laventure\Component\Database\Connection\Query\Builder\SQL\Criteria\CriteriaResolvedInterface;
use Laventure\Component\Database\Connection\Query\Builder\SQL\Criteria\SQLCriteriaResolver;
use Laventure\Component\Database\Connection\Query\Builder\SQL\SQLBuilderInterface;

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
        $expr        = $this->builder->expr();
        $bindParam   = $this->resolveBindingColumn($column);
        return new CriteriaResolved(
            $expr->in($column, ":$bindParam"),
            $column,
            $value
        );
    }




    /**
     * @inheritdoc
    */
    public function resolveWhereEqualTo($column, $value): CriteriaResolvedInterface
    {
        $expr        = $this->builder->expr();
        $bindParam   = $this->resolveBindingColumn($column);
        return new CriteriaResolved(
            $expr->eq($column, ":$bindParam"),
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