<?php
declare(strict_types=1);

namespace Laventure\Component\Database\Query\Builder;


use Laventure\Component\Database\Builder\SQL\Conditions\Contract\SQlBuilderConditionInterface;
use Laventure\Component\Database\Builder\SQL\DQL\Select\SelectBuilderInterface;
use Laventure\Component\Database\Builder\SQL\Expr\Conditions\andX;
use Laventure\Component\Database\Builder\SQL\Expr\Conditions\orX;
use Laventure\Component\Database\Builder\SQL\ExpressionInterface;
use Laventure\Component\Database\Builder\SQL\SQlBuilderInterface;
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
    protected Builder $builder;
    protected string $class;

    /**
     * @var array
    */
    public array $wheres = [
        'AND' => [],
        'OR'  => []
    ];



    /**
     * @var array
    */
    public array $having = [
        'AND' => [],
        'OR'  => []
    ];





    /**
     * @var array
    */
    protected array $parameters = [];





    /**
     * @var array
    */
    protected array $bindingParams = [];




    /**
     * @var array
    */
    protected array $bindingValues = [];





    /**
     * @param ConnectionInterface $connection
    */
    public function __construct(ConnectionInterface $connection)
    {
        $this->builder = new Builder($connection);
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
    public function select(string $columns = "*"): static
    {
        return $this->addSelect($columns);
    }




    /**
     * @inheritdoc
    */
    public function distinct(bool $distinct): static
    {
         $this->builder->select()->distinct($distinct);

         return $this;
    }





    /**
     * @inheritDoc
    */
    public function addSelect(string $columns): static
    {
        $this->builder->select()->addSelect($columns);

        return $this;
    }






    /**
     * @inheritDoc
    */
    public function from(string $from, string $alias = ''): static
    {
        $this->builder->select()->from($from, $alias);

        return $this;
    }




    /**
     * @inheritdoc
    */
    public function map(string $class): static
    {
        $this->class = $class;

        return $this;
    }







    /**
     * @inheritDoc
    */
    public function join(string $table, string $condition): static
    {
        $this->builder->select()->join($table, $condition);

        return $this;
    }




    /**
     * @inheritDoc
    */
    public function leftJoin(string $table, string $condition): static
    {
        $this->builder->select()->leftJoin($table, $condition);

        return $this;
    }




    /**
     * @inheritDoc
    */
    public function rightJoin(string $table, string $condition): static
    {
        $this->builder->select()->rightJoin($table, $condition);

        return $this;
    }




    /**
     * @inheritDoc
    */
    public function innerJoin(string $table, string $condition): static
    {
        $this->builder->select()->innerJoin($table, $condition);

        return $this;
    }




    /**
     * @inheritDoc
    */
    public function fullJoin(string $table, string $condition): static
    {
        $this->builder->select()->fullJoin($table, $condition);

        return $this;
    }




    /**
     * @inheritDoc
    */
    public function addJoin(string $join): static
    {
        $this->builder->select()->addJoin($join);

        return $this;
    }




    /**
     * @inheritDoc
    */
    public function groupBy(string $columns): static
    {
        $this->builder->select()->groupBy($columns);

        return $this;
    }





    /**
     * @inheritDoc
    */
    public function addGroupBy(string $columns): static
    {
        $this->builder->select()->addGroupBy($columns);

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
         $this->builder->select()->orderBy($column, $direction);

         return $this;
    }






    /**
     * @inheritDoc
    */
    public function addOrderBy(string ...$orders): static
    {
        $this->builder->select()->addOrderBy(join(', ', $orders));

        return $this;
    }




    /**
     * @inheritDoc
    */
    public function limit(int $limit): static
    {
        $this->builder->select()->limit($limit);

        return $this;
    }




    /**
     * @inheritDoc
    */
    public function offset($offset): static
    {
        $this->builder->select()->offset($offset);

        return $this;
    }




    /**
     * @inheritDoc
    */
    public function insert(string $table): static
    {
        $this->builder->insert()->insert($table);

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
        $this->builder->insert()->setValue($column, $value, $index);

        return $this;
    }




    /**
     * @inheritDoc
    */
    public function update(string $table, string $alias = ''): static
    {
        $this->builder->update()->update($table ? "$table $alias": $table);

        return $this;
    }





    /**
     * @inheritDoc
    */
    public function set(string $column, $value): static
    {
        $this->builder->update()->set($column, $value);

        return $this;
    }





    /**
     * @inheritDoc
    */
    public function delete(string $table, string $alias = ''): static
    {
        $this->builder->delete()->delete($table ? "$table $alias": $table);

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
     * @inheritDoc
    */
    public function criteria(array $criteria): static
    {
        foreach ($criteria as $column => $value) {
            $this->andWhere($this->resolveCriteria($column, $value));
            $this->setParameter($column, $value);
        }

        return $this;
    }







    /**
     * @param $id
     * @param $value
     * @return $this
    */
    public function setParameter($id, $value): static
    {
        $this->parameters[$id] = $value;

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
        $this->bindingParams[$id] = [$id, $value, intval($type)];

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
        $this->bindingValues[$id] = [$id, $value, intval($type)];

        return $this;
    }





    /**
     * @param $id
     * @return mixed
    */
    public function getParameter($id): mixed
    {
        return $this->parameters[$id] ?? null;
    }






    /**
     * @param array $parameters
     * @return $this
    */
    public function setParameters(array $parameters): static
    {
        $this->parameters = array_merge(
            $this->parameters,
            $parameters
        );

        return $this;
    }






    /**
     * @return array
    */
    public function getParameters(): array
    {
        return $this->parameters;
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
         return $this->getSQLBuilder()->getSQL();
    }





    /**
     * @inheritDoc
    */
    public function getQuery(): QueryInterface
    {
        $statement = $this->getSQLBuilder()->getQuery();

        if ($this->class) {
            $statement->map($this->class);
        }

        $statement->setParameters($this->parameters);
        $statement->bindValues($this->bindingValues);
        $statement->bindParams($this->bindingParams);
        return $statement;
    }






    /**
     * @return SQlBuilderInterface
    */
    public function getSQLBuilder(): SQlBuilderInterface
    {
        $builder  = $this->builder->getSQLBuilder();

        if ($builder instanceof SelectBuilderInterface) {
            $builder = $this->resolveHaving($builder);
        }

        if ($builder instanceof SQlBuilderConditionInterface) {
            $builder = $this->resolveWheres($builder);
        }

        $this->reset();

        return $builder;
    }





    /**
     * @return void
    */
    private function reset(): void
    {
        $this->wheres = [];
        $this->having = [];
    }




    /**
     * @param SelectBuilderInterface $builder
     * @return SQlBuilderInterface
    */
    private function resolveHaving(SelectBuilderInterface $builder): SQlBuilderInterface
    {
        $having = $this->resolveConditions($this->having);

        if (!empty($having)) {
            $builder->having(join(' ', $having));
        }

        return $builder;
    }





    /**
     * @param SQlBuilderConditionInterface $builder
     * @return SQlBuilderInterface
    */
    private function resolveWheres(SQlBuilderConditionInterface $builder): SQlBuilderInterface
    {
         $wheres = $this->resolveConditions($this->wheres);

         if (!empty($wheres)) {
             $builder->where(join(' ', $wheres));
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





    /**
     * @param string $column
     * @param $value
     * @return string
    */
    abstract protected function resolveCriteria(string $column, $value): string;
}
