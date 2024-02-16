<?php
declare(strict_types=1);

namespace Laventure\Component\Database\Query\Builder;


use Laventure\Component\Database\Builder\SQL\Conditions\Contract\SQlBuilderConditionInterface;
use Laventure\Component\Database\Builder\SQL\Criteria\Criteria;
use Laventure\Component\Database\Builder\SQL\DML\Delete\DeleteBuilderInterface;
use Laventure\Component\Database\Builder\SQL\DML\Insert\InsertSQlBuilderInterface;
use Laventure\Component\Database\Builder\SQL\DML\Update\UpdateBuilderInterface;
use Laventure\Component\Database\Builder\SQL\DQL\Select\SelectBuilderInterface;
use Laventure\Component\Database\Builder\SQL\Expr\Conditions\andX;
use Laventure\Component\Database\Builder\SQL\Expr\Conditions\orX;
use Laventure\Component\Database\Builder\SQL\ExpressionInterface;
use Laventure\Component\Database\Builder\SQL\SQlBuilderInterface;
use Laventure\Component\Database\Builder\SqlQueryBuilder;
use Laventure\Component\Database\Connection\ConnectionInterface;
use Laventure\Component\Database\Query\QueryInterface;


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
    protected string $class;




    /**
     * @var array
    */
    protected array $wheres = [
        'AND' => [],
        'OR'  => []
    ];



    /**
     * @var array
    */
    protected array $having = [
        'AND' => [],
        'OR'  => []
    ];



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
        $this->class = $classname;

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
        $this->andHaving($condition);

        return $this;
    }




    /**
     * @inheritDoc
    */
    public function andHaving(string $condition): static
    {
        $this->having['AND'][] = $condition;

        return $this;
    }





    /**
     * @inheritDoc
    */
    public function orHaving(string $condition): static
    {
        $this->having['OR'][] = $condition;

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
        return $this->andWhere($condition);
    }




    /**
     * @inheritDoc
    */
    public function andWhere(string $condition): static
    {
        $this->wheres['AND'][] = $condition;

        return $this;
    }




    /**
     * @inheritDoc
    */
    public function orWhere(string $condition): static
    {
        $this->wheres['OR'][] = $condition;

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
     * @return SQlBuilderInterface
    */
    public function getCurrent(): SQlBuilderInterface
    {
        $builder = $this->builder->current();

        if ($builder instanceof SelectBuilderInterface) {
            $builder = $this->resolveCurrentSelect($builder);
        }

        if ($builder instanceof SQlBuilderConditionInterface) {
            $builder = $this->resolveWheres($builder);
        }

        return $builder;
    }





    /**
     * @inheritDoc
    */
    public function getSQL(): string
    {
         return $this->getCurrent()->getSQL();
    }





    /**
     * @inheritDoc
    */
    public function getQuery(): QueryInterface
    {
        $statement = $this->getCurrent()->getQuery();
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
     * @param SelectBuilderInterface $builder
     * @return SQlBuilderInterface
    */
    private function resolveCurrentSelect(SelectBuilderInterface $builder): SQlBuilderInterface
    {
        $criteria = $this->resolveConditions($this->having);

        if (!empty($criteria)) {
            $builder->having(join(' ', $criteria));
        }

        return $builder;
    }



    /**
     * @param SQlBuilderConditionInterface $builder
     * @return SQlBuilderInterface
    */
    private function resolveWheres(SQlBuilderConditionInterface $builder): SQlBuilderInterface
    {
         $criteria = $this->resolveConditions($this->wheres);

         if (!empty($criteria)) {
             $builder->where(join(' ', $criteria));
         }

         return $builder;
    }




    /**
     * @param array $parses
     * @return array
    */
    private function resolveConditions(array $parses): array
    {
        $criteria = [];
        $key = key($parses);

        foreach ($parses as $type => $conditions) {
            if (!empty($conditions)) {
                $having = match($type) {
                    'AND' => new andX($conditions),
                    'OR'  => new orX($conditions),
                };
                if ($key !== $type) {
                    $criteria[] = $type;
                }
                $criteria[] = $having->__toString();
            }
        }

        return $criteria;
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
