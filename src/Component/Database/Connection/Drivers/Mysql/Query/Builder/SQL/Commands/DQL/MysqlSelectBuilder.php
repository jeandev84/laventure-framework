<?php
declare(strict_types=1);

namespace Laventure\Component\Database\Connection\Drivers\Mysql\Query\Builder\SQL\Commands\DQL;

use Laventure\Component\Database\Connection\ConnectionInterface;
use Laventure\Component\Database\Query\Builder\SQL\Conditions\Criteria\Resolver\SQLCriteriaResolverInterface;
use Laventure\Component\Database\Query\Builder\SQL\Criteria\CriteriaInterface;
use Laventure\Component\Database\Query\Builder\SQL\DQL\Select\SelectBuilderInterface;
use Laventure\Component\Database\Query\Builder\SQL\Expr\ExpressionBuilderInterface;
use Laventure\Component\Database\Query\QueryInterface;


/**
 * MysqlSelectBuilder
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\Connection\Drivers\Mysql\Query\Builder\SQL\Commands
*/
class MysqlSelectBuilder implements SelectBuilderInterface
{
    /**
     * @param SelectBuilderInterface $select
    */
    public function __construct(protected SelectBuilderInterface $select)
    {
    }




    /**
     * @inheritDoc
    */
    public function distinct(): static
    {
        $this->select->distinct();

        return $this;
    }




    /**
     * @inheritDoc
    */
    public function select(string $columns): static
    {
        $this->select->select($columns);

        return $this;
    }




    /**
     * @inheritDoc
    */
    public function addSelect(string $columns): static
    {
        $this->select->addSelect($columns);

        return $this;
    }




    /**
     * @inheritDoc
    */
    public function from(string $table, string $alias = ''): static
    {
        $this->select->from($table, $alias);

        return $this;
    }




    /**
     * @inheritDoc
    */
    public function join(string $table, string $condition): static
    {
        $this->select->join($table, $condition);

        return $this;
    }




    /**
     * @inheritDoc
    */
    public function leftJoin(string $table, string $condition): static
    {
        $this->select->join($table, $condition);

        return $this;
    }




    /**
     * @inheritDoc
    */
    public function rightJoin(string $table, string $condition): static
    {
        $this->select->rightJoin($table, $condition);

        return $this;
    }



    /**
     * @inheritDoc
    */
    public function innerJoin(string $table, string $condition): static
    {
         $this->select->innerJoin($table, $condition);

         return $this;
    }



    /**
     * @inheritDoc
    */
    public function fullJoin(string $table, string $condition): static
    {
        $this->select->fullJoin($table, $condition);

        return $this;
    }





    /**
     * @inheritDoc
    */
    public function addJoin(string $join): static
    {
        $this->select->addJoin($join);

        return $this;
    }




    /**
     * @inheritDoc
    */
    public function groupBy(string $columns): static
    {
        $this->select->groupBy($columns);

        return $this;
    }



    /**
     * @inheritDoc
    */
    public function addGroupBy(string $columns): static
    {
        $this->select->addGroupBy($columns);

        return $this;
    }



    /**
     * @inheritDoc
    */
    public function addHaving(string $condition, $type = null): static
    {
        $this->select->addHaving($condition, $type);

        return $this;
    }



    /**
     * @inheritDoc
    */
    public function having(string $condition): static
    {
        $this->select->having($condition);

        return $this;
    }



    /**
     * @inheritDoc
    */
    public function andHaving(string $condition): static
    {
        $this->select->andHaving($condition);

        return $this;
    }



    /**
     * @inheritDoc
    */
    public function orHaving(string $condition): static
    {
        $this->select->orHaving($condition);

        return $this;
    }



    /**
     * @inheritDoc
    */
    public function orderBy(string $column, string $direction = null): static
    {
        $this->select->orderBy($column, $direction);

        return $this;
    }




    /**
     * @inheritDoc
    */
    public function addOrderBy(array $orders): static
    {
        $this->select->addOrderBy($orders);

        return $this;
    }





    /**
     * @inheritDoc
    */
    public function limit($limit): static
    {
        $this->select->limit($limit);

        return $this;
    }




    /**
     * @inheritDoc
    */
    public function offset($offset): static
    {
        $this->select->offset($offset);

        return $this;
    }






    /**
     * @inheritDoc
    */
    public function where($condition): static
    {
        $this->select->where($condition);

        return $this;
    }






    /**
     * @inheritDoc
    */
    public function whereIn($column, array $value): static
    {
        $this->select->whereIn($column, $value);

        return $this;
    }





    /**
     * @inheritDoc
    */
    public function andWhere($condition): static
    {
        $this->select->andWhere($condition);

        return $this;
    }





    /**
     * @inheritDoc
    */
    public function orWhere($condition): static
    {
        $this->select->orWhere($condition);

        return $this;
    }




    /**
     * @inheritDoc
    */
    public function addWhere($condition, $type = null): static
    {
        $this->select->addWhere($condition, $type);

        return $this;
    }





    /**
     * @inheritDoc
    */
    public function criteria(array $conditions): static
    {
        $this->select->criteria($conditions);

        return $this;
    }





    /**
     * @inheritDoc
    */
    public function getWheres(): array
    {
        return $this->select->getWheres();
    }






    /**
     * @inheritDoc
     */
    public function setParameters(array $parameters): static
    {
        $this->select->setParameters($parameters);

        return $this;
    }





    /**
     * @inheritDoc
     */
    public function setParameter($id, $value): static
    {
        $this->select->setParameter($id, $value);

        return $this;
    }




    /**
     * @inheritDoc
     */
    public function getParameter($id): mixed
    {
        return $this->select->getParameter($id);
    }




    /**
     * @inheritDoc
     */
    public function getParameters(): array
    {
        return $this->select->getParameters();
    }




    /**
     * @inheritDoc
     */
    public function bindParam($id, $value, int $type = 0): static
    {
        $this->select->bindParam($id, $value, $type);

        return $this;
    }






    /**
     * @inheritDoc
     */
    public function bindValue($id, $value, int $type = 0): static
    {
        $this->select->bindValue($id, $value, $type);

        return $this;
    }




    /**
     * @inheritDoc
     */
    public function bindColumn($id, $value, int $type = 0): static
    {
        $this->select->bindColumn($id, $value, $type);

        return $this;
    }





    /**
     * @inheritDoc
    */
    public function getSQL(): string
    {
        return $this->select->getSQL();
    }





    /**
     * @inheritDoc
    */
    public function __toString()
    {
        return $this->getSQL();
    }




    /**
     * @inheritDoc
    */
    public function expr(): ExpressionBuilderInterface
    {
        return $this->select->expr();
    }





    /**
     * @inheritDoc
    */
    public function getConnection(): ConnectionInterface
    {
        return $this->select->getConnection();
    }




    /**
     * @inheritDoc
    */
    public function getQuery(): QueryInterface
    {
        return $this->select->getQuery();
    }




    /**
     * @inheritDoc
    */
    public function getCriteria(): CriteriaInterface
    {
        return $this->select->getCriteria();
    }



    /**
     * @inheritDoc
    */
    public function whereEqualTo($column, $value): static
    {
        $this->select->whereEqualTo($column, $value);

        return $this;
    }
}