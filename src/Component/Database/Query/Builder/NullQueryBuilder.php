<?php

declare(strict_types=1);

namespace Laventure\Component\Database\Query\Builder;

use Laventure\Component\Database\Builder\SQL\ExpressionInterface;
use Laventure\Component\Database\Connection\ConnectionInterface;
use Laventure\Component\Database\Connection\NullConnection;
use Laventure\Component\Database\Query\NullQuery;
use Laventure\Component\Database\Query\QueryInterface;

/**
 * NullQueryBuilder
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\Query\Builder
*/
class NullQueryBuilder implements QueryBuilderInterface
{
    /**
     * @inheritDoc
    */
    public function expr(): ExpressionInterface
    {
        throw new \RuntimeException("Could not found expression for null query builder.");
    }




    /**
     * @inheritDoc
    */
    public function select(string $columns = null, bool $distinct = false): static
    {
        return $this;
    }




    /**
     * @inheritDoc
    */
    public function addSelect(string $columns): static
    {
        return $this;
    }




    /**
     * @inheritDoc
    */
    public function from(string $from, string $alias = ''): static
    {
        return $this;
    }




    /**
     * @inheritDoc
    */
    public function map(string $class): static
    {
        return $this;
    }




    /**
     * @inheritDoc
    */
    public function join(string $table, string $condition): static
    {
        return $this;
    }





    /**
     * @inheritDoc
    */
    public function leftJoin(string $table, string $condition): static
    {
        return $this;
    }




    /**
     * @inheritDoc
    */
    public function rightJoin(string $table, string $condition): static
    {
        return $this;
    }





    /**
     * @inheritDoc
    */
    public function innerJoin(string $table, string $condition): static
    {
        return $this;
    }





    /**
     * @inheritDoc
    */
    public function fullJoin(string $table, string $condition): static
    {
        return $this;
    }





    /**
     * @inheritDoc
    */
    public function addJoin(string $join): static
    {
        return $this;
    }





    /**
     * @inheritDoc
    */
    public function groupBy(string $columns): static
    {
        return $this;
    }





    /**
     * @inheritDoc
    */
    public function addGroupBy(string $columns): static
    {
        return $this;
    }





    /**
     * @inheritDoc
    */
    public function having(string $condition): static
    {
        return $this;
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
    public function limit(int $limit): static
    {
        return $this;
    }




    /**
     * @inheritDoc
    */
    public function offset($offset): static
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
    public function set(string $column, $value): static
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
        return $this;
    }





    /**
     * @inheritDoc
    */
    public function criteria(array $criteria): static
    {
        return $this;
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
        return $id;
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
        return [];
    }




    /**
     * @inheritDoc
    */
    public function getConnection(): ConnectionInterface
    {
        return new NullConnection();
    }




    /**
     * @inheritDoc
    */
    public function getSQL(): string
    {
        return '';
    }




    /**
     * @inheritDoc
    */
    public function getQuery(): QueryInterface
    {
        return new NullQuery();
    }
}
