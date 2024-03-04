<?php
declare(strict_types=1);

namespace Laventure\Component\Database\Connection\Query\Builder\SQL\Criteria\PDO;

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
    public function resolveWhereIn($column, array $value): SQLBuilderInterface
    {
        $expr        = $this->builder->expr();
        $bindParam   = $this->resolveBindingColumn($column);
        $this->builder->andWhere($expr->in($column, ":$bindParam"));
        return $this->builder->setParameter($column, $value);
    }




    /**
     * @inheritdoc
    */
    public function resolveWhereEqualTo($column, $value): SQLBuilderInterface
    {
        $expr        = $this->builder->expr();
        $bindParam   = $this->resolveBindingColumn($column);
        $this->builder->andWhere($expr->eq($column, ":$bindParam"));
        return $this->builder->setParameter($column, $value);
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