<?php
declare(strict_types=1);

namespace Laventure\Component\Database\Connection\Drivers\Mysql\Query\Builder\SQL\Commands\DQL;

use Laventure\Component\Database\Connection\ConnectionInterface;
use Laventure\Component\Database\Query\Builder\SQL\Conditions\Criteria\Resolver\SQLCriteriaResolverInterface;
use Laventure\Component\Database\Query\Builder\SQL\DQL\Select\SelectBuilderInterface;
use Laventure\Component\Database\Query\Builder\SQL\Expr\ExpressionBuilderInterface;
use Laventure\Component\Database\Query\QueryInterface;


/**
 * Select
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\Connection\Drivers\Mysql\Query\Builder\SQL\Commands
*/
class Select implements SelectBuilderInterface
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
        // TODO: Implement select() method.
    }

    /**
     * @inheritDoc
     */
    public function addSelect(string $columns): static
    {
        // TODO: Implement addSelect() method.
    }

    /**
     * @inheritDoc
     */
    public function from(string $table, string $alias = ''): static
    {
        // TODO: Implement from() method.
    }

    /**
     * @inheritDoc
     */
    public function join(string $table, string $condition): static
    {
        // TODO: Implement join() method.
    }

    /**
     * @inheritDoc
     */
    public function leftJoin(string $table, string $condition): static
    {
        // TODO: Implement leftJoin() method.
    }

    /**
     * @inheritDoc
     */
    public function rightJoin(string $table, string $condition): static
    {
        // TODO: Implement rightJoin() method.
    }

    /**
     * @inheritDoc
     */
    public function innerJoin(string $table, string $condition): static
    {
        // TODO: Implement innerJoin() method.
    }

    /**
     * @inheritDoc
     */
    public function fullJoin(string $table, string $condition): static
    {
        // TODO: Implement fullJoin() method.
    }

    /**
     * @inheritDoc
     */
    public function addJoin(string $join): static
    {
        // TODO: Implement addJoin() method.
    }

    /**
     * @inheritDoc
     */
    public function groupBy(string $columns): static
    {
        // TODO: Implement groupBy() method.
    }

    /**
     * @inheritDoc
     */
    public function addGroupBy(string $columns): static
    {
        // TODO: Implement addGroupBy() method.
    }

    /**
     * @inheritDoc
     */
    public function addHaving(string $condition, $type = null): static
    {
        // TODO: Implement addHaving() method.
    }

    /**
     * @inheritDoc
     */
    public function having(string $condition): static
    {
        // TODO: Implement having() method.
    }

    /**
     * @inheritDoc
     */
    public function andHaving(string $condition): static
    {
        // TODO: Implement andHaving() method.
    }

    /**
     * @inheritDoc
     */
    public function orHaving(string $condition): static
    {
        // TODO: Implement orHaving() method.
    }

    /**
     * @inheritDoc
     */
    public function orderBy(string $column, string $direction = null): static
    {
        // TODO: Implement orderBy() method.
    }

    /**
     * @inheritDoc
     */
    public function addOrderBy(array $orders): static
    {
        // TODO: Implement addOrderBy() method.
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
        // TODO: Implement offset() method.
    }

    /**
     * @inheritDoc
     */
    public function __toString()
    {
        // TODO: Implement __toString() method.
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
        // TODO: Implement whereIn() method.
    }

    /**
     * @inheritDoc
     */
    public function andWhere($condition): static
    {
        // TODO: Implement andWhere() method.
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
    public function getSQL(): string
    {
        return $this->builder->getSQL();
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




    /**
     * @inheritDoc
    */
    public function expr(): ExpressionBuilderInterface
    {
        return $this->builder->expr();
    }
}