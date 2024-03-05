<?php
declare(strict_types=1);

namespace Laventure\Component\Database\Query\Builder\SQL\DQL\Select;

use Laventure\Component\Database\Connection\ConnectionInterface;
use Laventure\Component\Database\Query\Builder\SQL\Conditions\Criteria\Resolver\SQLCriteriaResolverInterface;
use Laventure\Component\Database\Query\Builder\SQL\Expr\ExpressionBuilderInterface;
use Laventure\Component\Database\Query\QueryInterface;

/**
 * SelectBuilderDecorator
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\Query\Builder\SQL\DQL\Select
*/
class SelectBuilderDecorator implements SelectBuilderInterface
{

    /**
     * @param SelectBuilderInterface $builder
     */
    public function __construct(protected SelectBuilderInterface $builder)
    {
    }




    /**
     * @inheritDoc
    */
    public function distinct(): static
    {
        $this->builder->distinct();

        return $this;
    }




    /**
     * @inheritDoc
    */
    public function select(string $columns): static
    {
        $this->builder->select($columns);

        return $this;
    }




    /**
     * @inheritDoc
    */
    public function addSelect(string $columns): static
    {
        $this->builder->addSelect($columns);

        return $this;
    }




    /**
     * @inheritDoc
    */
    public function from(string $table, string $alias = ''): static
    {
        $this->builder->from($table, $alias);

        return $this;
    }




    /**
     * @inheritDoc
    */
    public function join(string $table, string $condition): static
    {
        $this->builder->join($table, $condition);

        return $this;
    }




    /**
     * @inheritDoc
    */
    public function leftJoin(string $table, string $condition): static
    {
        $this->builder->leftJoin($table, $condition);

        return $this;
    }




    /**
     * @inheritDoc
    */
    public function rightJoin(string $table, string $condition): static
    {
        $this->builder->rightJoin($table, $condition);

        return $this;
    }




    /**
     * @inheritDoc
    */
    public function innerJoin(string $table, string $condition): static
    {
        $this->builder->innerJoin($table, $condition);

        return $this;
    }




    /**
     * @inheritDoc
    */
    public function fullJoin(string $table, string $condition): static
    {
        $this->builder->fullJoin($table, $condition);

        return $this;
    }




    /**
     * @inheritDoc
    */
    public function addJoin(string $join): static
    {
        $this->builder->addJoin($join);

        return $this;
    }




    /**
     * @inheritDoc
    */
    public function groupBy(string $columns): static
    {
        $this->builder->groupBy($columns);

        return $this;
    }




    /**
     * @inheritDoc
    */
    public function addGroupBy(string $columns): static
    {
        $this->builder->addGroupBy($columns);

        return $this;
    }



    /**
     * @inheritDoc
    */
    public function addHaving(string $condition, $type = null): static
    {
        $this->builder->addHaving($condition, $type);

        return $this;
    }




    /**
     * @inheritDoc
    */
    public function having(string $condition): static
    {
        $this->builder->having($condition);

        return $this;
    }



    /**
     * @inheritDoc
    */
    public function andHaving(string $condition): static
    {
        $this->builder->addHaving($condition);

        return $this;
    }




    /**
     * @inheritDoc
    */
    public function orHaving(string $condition): static
    {
        $this->builder->orHaving($condition);

        return $this;
    }




    /**
     * @inheritDoc
    */
    public function orderBy(string $column, string $direction = null): static
    {
        $this->builder->orderBy($column, $direction);

        return $this;
    }




    /**
     * @inheritDoc
    */
    public function addOrderBy(array $orders): static
    {

    }



    /**
     * @inheritDoc
    */
    public function limit($limit): static
    {
        // TODO: Implement limit() method.
    }




    /**
     * @inheritDoc
     */
    public function offset($offset): static
    {

    }






    /**
     * @inheritDoc
     */
    public function where($condition): static
    {
        // TODO: Implement where() method.
    }






    /**
     * @inheritDoc
     */
    public function whereIn($column, array $value): static
    {
        $this->builder->whereIn($column, $value);

        return $this;
    }





    /**
     * @inheritDoc
     */
    public function andWhere($condition): static
    {
        $this->builder->andWhere($condition);

        return $this;
    }





    /**
     * @inheritDoc
     */
    public function orWhere($condition): static
    {
        $this->builder->orWhere($condition);

        return $this;
    }




    /**
     * @inheritDoc
     */
    public function addWhere($condition, $type = null): static
    {
        $this->builder->addWhere($condition, $type);

        return $this;
    }




    /**
     * @inheritDoc
     */
    public function addCriteriaResolver(SQLCriteriaResolverInterface $criteriaResolver): static
    {
        $this->builder->addCriteriaResolver($criteriaResolver);

        return $this;
    }





    /**
     * @inheritDoc
     */
    public function criteria(array $conditions): static
    {
        $this->builder->criteria($conditions);

        return $this;
    }





    /**
     * @inheritDoc
     */
    public function getWheres(): array
    {
        return $this->builder->getWheres();
    }






    /**
     * @inheritDoc
     */
    public function setParameters(array $parameters): static
    {
        $this->builder->setParameters($parameters);

        return $this;
    }



    /**
     * @inheritDoc
     */
    public function setParameter($id, $value): static
    {
        $this->builder->setParameter($id, $value);

        return $this;
    }




    /**
     * @inheritDoc
     */
    public function getParameter($id): mixed
    {
        return $this->builder->getParameter($id);
    }




    /**
     * @inheritDoc
     */
    public function getParameters(): array
    {
        return $this->builder->getParameters();
    }




    /**
     * @inheritDoc
     */
    public function bindParam($id, $value, int $type = 0): static
    {
        $this->builder->bindParam($id, $value, $type);

        return $this;
    }






    /**
     * @inheritDoc
     */
    public function bindValue($id, $value, int $type = 0): static
    {
        $this->builder->bindValue($id, $value, $type);

        return $this;
    }




    /**
     * @inheritDoc
     */
    public function bindColumn($id, $value, int $type = 0): static
    {
        $this->builder->bindColumn($id, $value, $type);

        return $this;
    }





    /**
     * @inheritDoc
     */
    public function getSQL(): string
    {
        return $this->builder->getSQL();
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
        return $this->builder->expr();
    }





    /**
     * @inheritDoc
    */
    public function getConnection(): ConnectionInterface
    {
        return $this->builder->getConnection();
    }





    /**
     * @inheritDoc
    */
    public function getQuery(): QueryInterface
    {
        return $this->builder->getQuery();
    }
}