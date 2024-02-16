<?php
declare(strict_types=1);

namespace Laventure\Component\Database\Query\Builder;


use Laventure\Component\Database\Builder\SQL\DML\Delete\DeleteBuilderInterface;
use Laventure\Component\Database\Builder\SQL\DML\Insert\InsertBuilderInterface;
use Laventure\Component\Database\Builder\SQL\DML\Update\UpdateBuilderInterface;
use Laventure\Component\Database\Builder\SQL\DQL\Select\SelectBuilderInterface;
use Laventure\Component\Database\Builder\SQL\ExpressionInterface;
use Laventure\Component\Database\Builder\SqlQueryBuilder;
use Laventure\Component\Database\Connection\ConnectionInterface;
use Laventure\Component\Database\Query\QueryInterface;
use Laventure\Component\Database\Query\Result\QueryResultInterface;

/**
 * AbstractQueryBuilder
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\Query\Builder
 */
abstract class AbstractQueryBuilder implements QueryBuilderInterface
{
    /**
     * @var SqlQueryBuilder
    */
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
        $builder       = new SqlQueryBuilder($connection);
        $this->select  = $builder->select();
        $this->builder = $builder;
    }




    /**
     * @inheritDoc
    */
    public function expr(): ExpressionInterface
    {
        return $this->builder->expr();
    }




    /**
     * @inheritDoc
    */
    public function select(string $columns = null, bool $distinct = false): static
    {
        $columns = $columns ?: "*";
        $selects = ($distinct ? "DISTINCT $columns" : $columns);

        $this->select->select($selects);

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
    public function from(string $from, string $alias = ''): static
    {
        $this->select->from($from, $alias);

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
        $this->select->leftJoin($table, $condition);

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
    public function having(string $condition): static
    {
        $this->select->having($condition);

        return $this;
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
    public function addOrderBy(string $orders): static
    {
        // TODO: Implement addOrderBy() method.
    }

    /**
     * @inheritDoc
     */
    public function limit(int $limit): static
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
    public function insert(string $table): static
    {
        // TODO: Implement insert() method.
    }

    /**
     * @inheritDoc
     */
    public function values(array $values): static
    {
        // TODO: Implement values() method.
    }

    /**
     * @inheritDoc
     */
    public function setValue(string $column, $value, int $index = 0): static
    {
        // TODO: Implement setValue() method.
    }

    /**
     * @inheritDoc
     */
    public function update(string $table, string $alias = ''): static
    {
        // TODO: Implement update() method.
    }

    /**
     * @inheritDoc
     */
    public function set(string $column, $value): static
    {
        // TODO: Implement set() method.
    }

    /**
     * @inheritDoc
    */
    public function delete(string $table, string $alias = ''): static
    {

    }




    /**
     * @inheritDoc
    */
    public function where(string $condition): static
    {

    }



    /**
     * @inheritDoc
    */
    public function andWhere(string $condition): static
    {

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
    public function bindParam($id, $value, $type = null): static
    {

    }




    /**
     * @inheritDoc
    */
    public function setParameter($id, $value): static
    {

    }




    /**
     * @inheritDoc
    */
    public function getParameter($id): mixed
    {
        return $this;
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
        return $this->builder->getConnection();
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
    public function getQuery(): QueryInterface
    {

    }





    /**
     * @inheritDoc
    */
    public function fetch(): QueryResultInterface
    {
        return $this->select->fetch();
    }





    /**
     * @return SelectBuilderInterface
    */
    public function getSelect(): SelectBuilderInterface
    {

    }




    /**
     * @return InsertBuilderInterface
    */
    public function getInsert(): InsertBuilderInterface
    {

    }





    /**
     * @return UpdateBuilderInterface
    */
    public function getUpdate(): UpdateBuilderInterface
    {

    }






    /**
     * @return DeleteBuilderInterface
    */
    public function getDelete(): DeleteBuilderInterface
    {

    }
}
