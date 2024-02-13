<?php
declare(strict_types=1);

namespace Laventure\Component\Database\Query\Builder;


use Laventure\Component\Database\Builder\SQL\BuilderInterface;
use Laventure\Component\Database\Builder\SQL\DML\Delete\DeleteBuilderInterface;
use Laventure\Component\Database\Builder\SQL\DML\Insert\InsertBuilderInterface;
use Laventure\Component\Database\Builder\SQL\DML\Update\UpdateBuilderInterface;
use Laventure\Component\Database\Builder\SQL\DQL\Select\SelectBuilderInterface;
use Laventure\Component\Database\Builder\SQL\ExpressionInterface;
use Laventure\Component\Database\Builder\SqlQueryBuilder;
use Laventure\Component\Database\Connection\ConnectionInterface;
use Laventure\Component\Database\Query\QueryInterface;

/**
 * QueryBuilder
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\Query\Builder
 */
class QueryBuilder implements QueryBuilderInterface
{

    protected BuilderInterface $current;
    protected SqlQueryBuilder $builder;
    protected SelectBuilderInterface $select;
    protected InsertBuilderInterface $insert;
    protected UpdateBuilderInterface $update;
    protected DeleteBuilderInterface $delete;


    /**
     * @param ConnectionInterface $connection
    */
    public function __construct(ConnectionInterface $connection)
    {
        $this->builder = new SqlQueryBuilder($connection);
        $this->select  = $this->builder->select();
        $this->withSQL($this->select);
    }



    /**
     * @inheritDoc
    */
    public function select(string $columns = null): static
    {
        return $this->withSQL(
            $this->select->select($columns)
        );
    }




    /**
     * @inheritDoc
    */
    public function addSelect(string $columns): static
    {
        return $this->withSQL(
            $this->select->addSelect($columns)
        );
    }



    /**
     * @inheritDoc
    */
    public function from(string $from, string $alias = ''): static
    {
        return $this->withSQL(
            $this->select->from($from, $alias)
        );
    }




    /**
     * @inheritDoc
    */
    public function addFrom(string $from): static
    {
        return $this->withSQL(
            $this->select->addFrom($from)
        );
    }




    /**
     * @inheritDoc
    */
    public function join(string $table, string $condition): static
    {
         return $this->withSQL(
             $this->select->join($table, $condition)
         );
    }




    /**
     * @inheritDoc
    */
    public function leftJoin(string $table, string $condition): static
    {
         return $this->withSQL(
             $this->select->leftJoin($table, $condition)
         );
    }




    /**
     * @inheritDoc
    */
    public function rightJoin(string $table, string $condition): static
    {
         return $this->withSQL(
             $this->select->rightJoin($table, $condition)
         );
    }




    /**
     * @inheritDoc
    */
    public function innerJoin(string $table, string $condition): static
    {
        return $this->withSQL(
            $this->select->innerJoin($table, $condition)
        );
    }




    /**
     * @inheritDoc
    */
    public function fullJoin(string $table, string $condition): static
    {
        return $this->withSQL(
            $this->select->fullJoin($table, $condition)
        );
    }





    /**
     * @inheritDoc
    */
    public function addJoin(string $join): static
    {
        return $this->withSQL(
            $this->select->addJoin($join)
        );
    }




    /**
     * @inheritDoc
    */
    public function groupBy(string ...$columns): static
    {
        return $this->withSQL(
            $this->select->groupBy(...$columns)
        );
    }




    /**
     * @inheritDoc
    */
    public function addGroupBy(string ...$columns): static
    {
        return $this->withSQL(
            $this->select->addGroupBy(...$columns)
        );
    }




    /**
     * @inheritDoc
    */
    public function having(string $condition): static
    {
        return $this->withSQL(
            $this->select->having($condition)
        );
    }




    /**
     * @inheritDoc
    */
    public function andHaving(string $condition): static
    {
        return $this;
    }




    /**
     * @inheritDoc
    */
    public function orHaving(string $condition): static
    {
        return $this;
    }




    /**
     * @inheritDoc
    */
    public function orderBy(string $column, string $direction = null): static
    {
        return $this;
    }









    /**
     * @inheritDoc
    */
    public function addOrderBy(string ...$orders): static
    {
        return $this;
    }



    /**
     * @inheritDoc
    */
    public function setMaxResults($limit): static
    {
        return $this;
    }




    /**
     * @inheritDoc
    */
    public function setFirstResult($offset): static
    {
        return $this;
    }




    /**
     * @inheritDoc
    */
    public function insert(string $table): static
    {
        return $this;
    }




    /**
     * @inheritDoc
    */
    public function values(array $values): static
    {
        return $this;
    }




    /**
     * @inheritDoc
    */
    public function setValue(string $column, $value, int $index = 0): static
    {
        return $this;
    }





    /**
     * @inheritDoc
    */
    public function update(string $table, string $alias = ''): static
    {
         return $this;
    }




    /**
     * @inheritDoc
    */
    public function set($column, $value): static
    {
        return $this;
    }




    /**
     * @inheritDoc
    */
    public function delete(string $table, string $alias = ''): static
    {
         return $this;
    }




    /**
     * @inheritDoc
    */
    public function where(string $condition): static
    {
         return $this;
    }





    /**
     * @inheritDoc
    */
    public function andWhere(string $condition): static
    {
        return $this;
    }




    /**
     * @inheritDoc
    */
    public function orWhere(string $condition): static
    {

    }





    /**
     * @inheritDoc
    */
    public function criteria(array $criteria): static
    {

    }




    /**
     * @inheritDoc
    */
    public function getSQL(): string
    {

    }





    /**
     * @inheritDoc
    */
    public function bindParam($id, $value, $type = null): static
    {
         return $this;
    }





    /**
     * @inheritDoc
    */
    public function setParameter($id, $value): static
    {
         return $this;
    }




    /**
     * @inheritDoc
    */
    public function getParameter($id): mixed
    {

    }





    /**
     * @inheritDoc
    */
    public function setParameters(array $parameters): static
    {
        return $this;
    }





    /**
     * @inheritDoc
    */
    public function getParameters(): array
    {

    }





    /**
     * @inheritDoc
    */
    public function getConnection(): ConnectionInterface
    {

    }




    /**
     * @inheritDoc
    */
    public function getQuery(): QueryInterface
    {

    }



    /**
     * @inheritDoc
    */
    public function expr(): ExpressionInterface
    {

    }




    /**
     * @param BuilderInterface $current
     * @return $this
    */
    protected function withSQL(BuilderInterface $current): static
    {
         $this->current = $current;

         return $this;
    }
}