<?php

declare(strict_types=1);

namespace Laventure\Component\Database\Query\Builder;

use Laventure\Component\Database\Connection\ConnectionInterface;
use Laventure\Component\Database\Query\Builder\Criteria\QueryBuilderCriteria;
use Laventure\Component\Database\Query\Builder\SQL\Conditions\Where\WhereInterface;
use Laventure\Component\Database\Query\Builder\SQL\Criteria\Criteria;
use Laventure\Component\Database\Query\Builder\SQL\Criteria\CriteriaInterface;
use Laventure\Component\Database\Query\Builder\SQL\DML\Delete\DeleteBuilderInterface;
use Laventure\Component\Database\Query\Builder\SQL\DML\Insert\InsertBuilderInterface;
use Laventure\Component\Database\Query\Builder\SQL\DML\Update\UpdateBuilderInterface;
use Laventure\Component\Database\Query\Builder\SQL\DQL\Select\SelectBuilderInterface;
use Laventure\Component\Database\Query\Builder\SQL\Expr\ExpressionBuilderInterface;
use Laventure\Component\Database\Query\Builder\SQL\Factory\SQLBuilderFactory;
use Laventure\Component\Database\Query\Builder\SQL\Factory\SQLBuilderFactoryInterface;
use Laventure\Component\Database\Query\Builder\SQL\SQLBuilderInterface;
use Laventure\Component\Database\Query\QueryInterface;

/**
 * PdoQueryBuilder
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\Statement\Builder
*/
abstract class QueryBuilder implements QueryBuilderInterface
{
    /**
     * @var SQLBuilderFactoryInterface
    */
    protected SQLBuilderFactoryInterface $factory;



    /**
     * @var SelectBuilderInterface
    */
    protected SelectBuilderInterface $select;


    /**
     * @var InsertBuilderInterface
    */
    protected InsertBuilderInterface $insert;




    /**
     * @var UpdateBuilderInterface
    */
    protected UpdateBuilderInterface $update;





    /**
     * @var DeleteBuilderInterface
    */
    protected DeleteBuilderInterface $delete;




    /**
     * @var SQLBuilderInterface
    */
    protected SQLBuilderInterface $builder;




    /**
     * @var QueryBuilderCriteria
    */
    protected QueryBuilderCriteria $criteria;






    /**
     * @param ConnectionInterface $connection
    */
    public function __construct(ConnectionInterface $connection)
    {
        $this->factory  = new SQLBuilderFactory($connection);
        $this->criteria = new QueryBuilderCriteria();
        $this->select   = $this->factory->createSelectBuilder();
        $this->insert   = $this->factory->createInsertBuilder();
        $this->update   = $this->factory->createUpdateBuilder();
        $this->delete   = $this->factory->createDeleteBuilder();
    }





    /**
     * @inheritDoc
    */
    public function expr(): ExpressionBuilderInterface
    {
        return $this->factory->createExpr();
    }






    /**
     * @inheritDoc
    */
    public function select($columns = null): static
    {
        return $this->addSelect($columns);
    }





    /**
     * @inheritDoc
    */
    public function distinct(): static
    {
        return $this->with($this->select->distinct());
    }





    /**
     * @inheritDoc
    */
    public function addSelect($selects): static
    {
        return $this->with($this->select->addSelect($selects));
    }





    /**
     * @inheritDoc
    */
    public function from(string $from, string $alias = ''): static
    {
        return $this->with($this->select->from($from, $alias));
    }





    /**
     * @inheritDoc
    */
    public function map(string $classname): static
    {
        $this->criteria->classname = $classname;

        return $this;
    }




    /**
     * @inheritDoc
    */
    public function join(string $table, string $condition): static
    {
        return $this->with($this->select->join($table, $condition));
    }




    /**
     * @inheritDoc
    */
    public function leftJoin(string $table, string $condition): static
    {
        return $this->with($this->select->leftJoin($table, $condition));
    }




    /**
     * @inheritDoc
    */
    public function rightJoin(string $table, string $condition): static
    {
        return $this->with($this->select->rightJoin($table, $condition));
    }




    /**
     * @inheritDoc
    */
    public function innerJoin(string $table, string $condition): static
    {
        return $this->with($this->select->innerJoin($table, $condition));
    }






    /**
     * @inheritDoc
    */
    public function fullJoin(string $table, string $condition): static
    {
        return $this->with($this->select->fullJoin($table, $condition));
    }





    /**
     * @inheritDoc
    */
    public function addJoin(string $join): static
    {
        return $this->with($this->select->addJoin($join));
    }





    /**
     * @inheritDoc
    */
    public function groupBy(string $columns): static
    {
        return $this->with($this->select->groupBy($columns));
    }




    /**
     * @inheritDoc
    */
    public function addGroupBy(string $columns): static
    {
        return $this->with($this->select->addGroupBy($columns));
    }






    /**
     * @inheritDoc
    */
    public function addHaving(string $condition, $type = null): static
    {
        return $this->with($this->select->addHaving($type));
    }





    /**
     * @inheritDoc
    */
    public function having(string $condition): static
    {
        return $this->with($this->select->having($condition));
    }






    /**
     * @inheritDoc
    */
    public function andHaving(string $condition): static
    {
        return $this->with($this->select->addHaving($condition));
    }





    /**
     * @inheritDoc
    */
    public function orHaving(string $condition): static
    {
        return $this->with($this->select->orHaving($condition));
    }




    /**
     * @inheritDoc
    */
    public function orderBy(string $column, string $direction = null): static
    {
        return $this->with($this->select->orderBy($column, $direction ?: 'ASC'));
    }





    /**
     * @inheritDoc
    */
    public function addOrderBy(array $orders): static
    {
        return $this->with($this->select->addOrderBy($orders));
    }





    /**
     * @inheritDoc
    */
    public function limit($limit): static
    {
        return $this->with($this->select->limit($limit));
    }




    /**
     * @inheritDoc
    */
    public function offset($offset): static
    {
        return $this->with($this->select->offset($offset));
    }




    /**
     * @inheritDoc
    */
    public function insert(string $table): static
    {
        return $this->with($this->insert->insert($table));
    }





    /**
     * @inheritDoc
    */
    public function values(array $values): static
    {
        if ($this->insert->hasMultiple($values)) {
            $this->addMultipleInsert($values);
        } else {
            $this->addInsert($values);
        }

        return $this;
    }





    /**
     * @inheritDoc
    */
    public function setValue(string $column, $value, int $index = 0): static
    {
        return $this->with($this->insert->setValue($column, $value, $index));
    }






    /**
     * @inheritDoc
    */
    public function update(string $table): static
    {
        return $this->with($this->update->update($table));
    }








    /**
     * @inheritDoc
    */
    public function set($column, $value): static
    {
        return $this->with($this->update->set($column, $value));
    }








    /**
     * @inheritDoc
    */
    public function delete($table): static
    {
        return $this->with($this->delete->delete($table));
    }





    /**
     * @inheritDoc
    */
    public function criteria(array $criteria): static
    {
        foreach ($criteria as $column => $value) {
            if (is_array($value)) {
                $this->whereIn($column, $value);
            } else {
                $this->whereEqualTo($column, $value);
            }
        }

        return $this;
    }








    /**
     * @inheritDoc
    */
    public function where($condition): static
    {
        return $this->addCondition(__METHOD__, $condition);
    }






    /**
     * @inheritDoc
    */
    public function whereIn($column, array $value): static
    {
        $arguments = compact('column', 'value');

        return $this->addCondition(__METHOD__, $arguments);
    }






    /**
     * @inheritDoc
    */
    public function whereEqualTo($column, $value): static
    {
        $arguments = compact('column', 'value');

        return $this->addCondition(__METHOD__, $arguments);
    }







    /**
     * @inheritDoc
    */
    public function andWhere($condition): static
    {
        return $this->addCondition(__METHOD__, $condition);
    }




    /**
     * @inheritDoc
    */
    public function orWhere($condition): static
    {
        return $this->addCondition(__METHOD__, $condition);
    }




    /**
     * @inheritDoc
    */
    public function setParameters(array $parameters): static
    {
        foreach ($parameters as $column => $value) {
            $this->setParameter($column, $value);
        }

        return $this;
    }





    /**
     * @inheritDoc
    */
    public function setParameter($id, $value): static
    {
        $this->criteria->parameters[$id] = $value;

        return $this;
    }






    /**
     * @inheritDoc
    */
    public function getSQL(): string
    {
        return $this->getBuilder()->getSQL();
    }







    /**
     * @inheritDoc
    */
    public function getQuery(): QueryInterface
    {
        $statement = $this->getBuilder()->getQuery();

        if ($this->criteria->classname) {
            $statement->map($this->criteria->classname);
        }

        return $statement;
    }





    /**
     * @inheritDoc
    */
    public function getCriteria(): CriteriaInterface
    {
        $this->criteria->merge(
            $this->getBuilder()->getCriteria()->toArray()
        );

        return $this->criteria;
    }






    /**
     * @return SQLBuilderInterface
    */
    private function getBuilder(): SQLBuilderInterface
    {
        $this->parseWheres();
        $this->parseParameters();

        return $this->builder;
    }







    /**
     * @param string $method
     * @param $condition
     * @return $this
    */
    protected function addCondition(string $method, $condition): static
    {
        $method = explode('::', $method, 2)[1];

        $this->criteria->wheres[$method][] = $condition;

        return $this;
    }






    /**
     * @param SQLBuilderInterface $builder
     * @return $this
    */
    protected function with(SQLBuilderInterface $builder): static
    {
        $this->builder = $builder;

        return $this;
    }


    /**
     * @param object $object
     * @param string $method
     * @param array $arguments
     * @return object
    */
    protected function call(object $object, string $method, array $arguments): object
    {
        if (is_callable([$object, $method])) {
            return call_user_func_array([$object, $method], $arguments);
        }

        return $object;
    }







    /**
     * @return void
    */
    private function parseWheres(): void
    {
        if ($this->builder instanceof WhereInterface) {
            foreach ($this->criteria->wheres as $method => $conditions) {
                foreach ($conditions as $condition) {
                    if (is_callable([$this->builder, $method])) {
                        $this->call($this->builder, $method, [$condition]);
                    }
                }
            }
        }
    }




    /**
     * @return void
    */
    private function parseParameters(): void
    {
        $this->builder->setParameters($this->criteria->parameters);
    }








    /**
     * @param array $values
     * @return $this
     */
    abstract public function addMultipleInsert(array $values): static;






    /**
     * @param array $attributes
     * @return $this
    */
    abstract public function addInsert(array $attributes): static;
}
