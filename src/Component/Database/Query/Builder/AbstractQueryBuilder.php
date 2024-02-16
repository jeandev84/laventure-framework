<?php
declare(strict_types=1);

namespace Laventure\Component\Database\Query\Builder;


use Laventure\Component\Database\Builder\SQL\Criteria\Criteria;
use Laventure\Component\Database\Builder\SQL\DML\Delete\DeleteBuilderInterface;
use Laventure\Component\Database\Builder\SQL\DML\Insert\InsertSQlBuilderInterface;
use Laventure\Component\Database\Builder\SQL\DML\Update\UpdateBuilderInterface;
use Laventure\Component\Database\Builder\SQL\DQL\Select\SelectBuilderInterface;
use Laventure\Component\Database\Builder\SQL\ExpressionInterface;
use Laventure\Component\Database\Builder\SqlQueryBuilder;
use Laventure\Component\Database\Connection\ConnectionInterface;
use Laventure\Component\Database\Query\QueryInterface;
use Laventure\Component\Database\Query\Result\QueryResultInterface;
use Laventure\Contract\Builder\BuilderInterface;

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
    protected InsertSQlBuilderInterface $insert;
    protected UpdateBuilderInterface $update;
    protected DeleteBuilderInterface $delete;
    protected Criteria $criteria;
    protected ExpressionInterface $expr;



    /**
     * @param ConnectionInterface $connection
    */
    public function __construct(ConnectionInterface $connection)
    {
        $builder        = new SqlQueryBuilder($connection);
        $this->criteria = new Criteria();
        $this->expr     = $builder->expr();
        $this->select   = $builder->select()->criteria($this->criteria);
        $this->builder  = $builder;
    }




    /**
     * @inheritDoc
    */
    public function expr(): ExpressionInterface
    {
        return $this->expr;
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
     * @inheritdoc
    */
    public function map(string $classname): static
    {
        $this->classname = $classname;

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
         $this->select->orderBy($column, $direction);

         return $this;
    }



    /**
     * @inheritDoc
    */
    public function addOrderBy(string ...$orders): static
    {
        $this->select->addOrderBy(join(', ', $orders));

        return $this;
    }




    /**
     * @inheritDoc
    */
    public function limit(int $limit): static
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
    public function insert(string $table): static
    {
        $this->insert->insert($table)
                     ->criteria($this->criteria);

        return $this;
    }




    /**
     * @inheritDoc
     */
    public function values(array $values): static
    {
        if (isset($values[0])) {
            foreach ($values as $position => $attributes) {
                $this->resolveMultipleInsert($position, $attributes);
            }
        } else {
            $this->resolveInsert($values);
        }

        return $this;
    }





    /**
     * @inheritDoc
    */
    public function setValue(string $column, $value, int $index = 0): static
    {
        $this->insert->setValue($column, $value, $index);

        return $this;
    }




    /**
     * @inheritDoc
    */
    public function update(string $table, string $alias = ''): static
    {
        $this->update->update($table ? "$table $alias": $table)
                     ->criteria($this->criteria);

        return $this;
    }





    /**
     * @inheritDoc
    */
    public function set(string $column, $value): static
    {
        $this->update->set($column, $value);

        return $this;
    }





    /**
     * @inheritDoc
    */
    public function delete(string $table, string $alias = ''): static
    {
        $this->delete->delete($table ? "$table $alias": $table)
                     ->criteria($this->criteria);

        return $this;
    }




    /**
     * @inheritDoc
    */
    public function where(string $condition): static
    {
        $this->criteria->wheres[] = $condition;

        return $this;
    }




    /**
     * @inheritDoc
    */
    public function andWhere(string $condition): static
    {
        $this->criteria->wheres['AND'][] = $condition;

        return $this;
    }




    /**
     * @inheritDoc
    */
    public function orWhere(string $condition): static
    {
        $this->criteria->wheres['OR'][] = $condition;

        return $this;
    }





    /**
     * @param $id
     * @param $value
     * @return $this
    */
    public function setParameter($id, $value): static
    {
        $this->criteria->parameters[$id] = $value;

        return $this;
    }






    /**
     * @param $id
     * @param $value
     * @param $type
     * @return $this
    */
    public function bindParam($id, $value, $type = null): static
    {
        $this->criteria->bindingParams[$id] = [$id, $value, intval($type)];

        return $this;
    }






    /**
     * @param $id
     * @param $value
     * @param $type
     * @return $this
    */
    public function bindValue($id, $value, $type = null): static
    {
        $this->criteria->bindingValues[$id] = [$id, $value, intval($type)];

        return $this;
    }





    /**
     * @param $id
     * @return mixed
    */
    public function getParameter($id): mixed
    {
        return $this->criteria->parameters[$id] ?? null;
    }






    /**
     * @param array $parameters
     * @return $this
    */
    public function setParameters(array $parameters): static
    {
        $this->criteria->parameters = array_merge(
            $this->criteria->parameters,
            $parameters
        );

        return $this;
    }






    /**
     * @return array
    */
    public function getParameters(): array
    {
        return $this->criteria->parameters;
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
         return $this->builder->getCurrent()->getSQL();
    }





    /**
     * @inheritDoc
    */
    public function getQuery(): QueryInterface
    {
        $statement = $this->builder->getCurrent()->getQuery();
        $statement->setParameters($this->criteria->parameters);
        $statement->bindValues($this->criteria->bindingValues);
        $statement->bindParams($this->criteria->bindingParams);
        return $statement;
    }






    /**
     * @return SelectBuilderInterface
    */
    public function getSelect(): SelectBuilderInterface
    {
       return $this->select;
    }




    /**
     * @return InsertSQlBuilderInterface
    */
    public function getInsert(): InsertSQlBuilderInterface
    {
       return $this->insert;
    }





    /**
     * @return UpdateBuilderInterface
    */
    public function getUpdate(): UpdateBuilderInterface
    {
        return $this->update;
    }






    /**
     * @return DeleteBuilderInterface
    */
    public function getDelete(): DeleteBuilderInterface
    {
        return $this->delete;
    }




    /**
     * @inheritdoc
    */
    public function getCriteria(): Criteria
    {
        return $this->criteria;
    }




    /**
     * @param array $attributes
     * @param int $position
     * @return $this
    */
    abstract protected function resolveMultipleInsert(int $position, array $attributes): static;




    /**
     * @param array $attributes
     * @return $this
    */
    abstract protected function resolveInsert(array $attributes): static;
}
