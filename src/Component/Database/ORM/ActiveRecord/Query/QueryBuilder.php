<?php
declare(strict_types=1);

namespace Laventure\Component\Database\ORM\ActiveRecord\Query;

use Laventure\Component\Database\ORM\ActiveRecord\Contract\ActiveRecordInterface;
use Laventure\Component\Database\ORM\ActiveRecord\Contract\Timestamps\TimestampsInterface;
use Laventure\Component\Database\ORM\ActiveRecord\Exception\ActiveRecordException;
use Laventure\Component\Database\ORM\ActiveRecord\Exception\NotFoundTableNameException;
use Laventure\Component\Database\Query\Builder\SQL\Conditions\Where\WhereInterface;
use Laventure\Component\Database\Query\Builder\SQL\SQLBuilder;
use Laventure\Component\Database\Query\QueryInterface;
use Laventure\Component\Database\Query\Builder\SQL\Conditions\ConditionType;
use Laventure\Component\Database\Query\Builder\SQL\DQL\Select\SelectBuilderInterface;
use Laventure\Component\Database\Query\Builder\SQL\Expr\ExpressionBuilderInterface;
use Laventure\Component\Database\Query\Builder\SQL\SQLQueryBuilderInterface;

/**
 * QueryBuilder
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\ORM\ActiveRecord\Query
*/
class QueryBuilder implements QueryBuilderInterface
{

    const andWhere = 'andWhere';
    const orWhere  = 'orWhere';
    const criteria = 'criteria';


    /**
     * @var ActiveRecordInterface
    */
    protected ActiveRecordInterface $model;


    /**
     * @var SQLQueryBuilderInterface
    */
    protected SQLQueryBuilderInterface $builder;




    /**
     * @var SelectBuilderInterface
    */
    protected SelectBuilderInterface $select;




    /**
     * @var array
    */
    protected array $wheres = [
        self::andWhere => [],
        self::orWhere  => [],
        self::criteria => []
    ];




    /**
     * @var array
    */
    protected array $parameters = [];


    
    
    
    /**
     * @param ActiveRecordInterface $model
     * @throws NotFoundTableNameException
    */
    public function __construct(ActiveRecordInterface $model)
    {
        $this->bootModel($model);
    }






    /**
     * @inheritDoc
    */
    public function getClassName(): string
    {
        $modelName = $this->model->getClassName();

        if (!$modelName) {
            $modelName = get_class($this->model);
        }

        return $modelName;
    }




    /**
     * @inheritDoc
    */
    public function getTableName(): string
    {
        if(!$tableName = $this->model->getTableName()) {
            throw new NotFoundTableNameException($this->getClassName(), [
                'context' => get_class()
            ]);
        }

        return $tableName;
    }





    /**
     * @inheritDoc
    */
    public function getPrimaryKey(): string
    {
        return $this->model->getPrimaryKey();
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
    public function select(string ...$columns): static
    {
        $this->select->select(join(', ', $columns));

        return $this;
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
    public function orderBy(string $column, string $direction = null): static
    {
        $this->select->orderBy($column, $direction ?: 'ASC');

        return $this;
    }





    /**
     * @inheritDoc
    */
    public function groupBy(string $column): static
    {
        $this->select->groupBy($column);

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
    public function limit(int $limit): static
    {
        $this->select->limit($limit);

        return $this;
    }





    /**
     * @inheritDoc
    */
    public function offset(int $offset): static
    {
         $this->select->offset($offset);

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
        return $this->addCondition($condition, self::andWhere);
    }





    /**
     * @inheritDoc
    */
    public function orWhere(string $condition): static
    {
        return $this->addCondition($condition, self::orWhere);
    }





    /**
     * @inheritDoc
    */
    public function criteria(array $criteria): static
    {
        return $this->addCriteria($criteria);
    }





    /**
     * @inheritDoc
    */
    public function create(array $attributes): int
    {
        $query = $this->insertQuery($attributes);

        if (!$query->execute()) {
            return 0;
        }

        return $query->lastInsertId();
    }





    /**
     * @inheritDoc
     * @throws NotFoundTableNameException
    */
    public function update(array $attributes): bool
    {
        return $this->updateQuery($attributes)->execute();
    }







    /**
     * @inheritDoc
     * @throws NotFoundTableNameException
    */
    public function delete(): bool
    {
         return $this->deleteQuery()->execute();
    }





    /**
     * @inheritDoc
    */
    public function one(): mixed
    {
        return $this->selectQuery()
                    ->fetch()
                    ->one();
    }





    /**
     * @inheritDoc
    */
    public function get(): array
    {
       return $this->selectQuery()
                   ->fetch()
                   ->all();
    }





    /**
     * @inheritDoc
    */
    public function assoc(): array
    {
        return $this->selectQuery()
                    ->fetch()
                    ->assoc();
    }





    /**
     * @inheritDoc
    */
    public function columns(): array
    {
        return $this->selectQuery()
                    ->fetch()
                    ->columns();
    }





    /**
     * @inheritDoc
    */
    public function first(): mixed
    {
        return $this->selectQuery()
                    ->fetch()
                    ->first();
    }





    /**
     * @inheritDoc
    */
    public function count(): int
    {
        return $this->selectQuery()
                    ->fetch()
                    ->count();
    }





    /**
     * @inheritDoc
    */
    public function paginate(int $page, int $limit): array
    {
          $this->limit($limit)->offset($limit * abs($page - 1));

          return $this->selectQuery()->fetch()->all();
    }







    /**
     * @inheritDoc
    */
    public function setParameters(array $parameters): static
    {
         foreach ($parameters as $id => $value) {
             $this->setParameter($id, $value);
         }

         return $this;
    }





    /**
     * @inheritDoc
    */
    public function setParameter($id, $value): static
    {
        $this->parameters[$id] = $value;

        return $this;
    }







    /**
     * @inheritDoc
    */
    public function find($id): mixed
    {
        return $this->select
                    ->criteria([$this->getPrimaryKey() => $id])
                    ->getQuery()
                    ->map($this->getClassName())
                    ->fetch()
                    ->one();
    }





    /**
     * @inheritDoc
    */
    public function all(): array
    {
        return $this->select()->get();
    }





    /**
     * @param string $condition
     * @param string $type
     * @return $this
    */
    private function addCondition(string $condition, string $type): static
    {
        $this->wheres[$type][] = $condition;

        return $this;
    }





    /**
     * @param array $criteria
     * @return $this
    */
    public function addCriteria(array $criteria): static
    {
        foreach ($criteria as $column => $value) {
            $this->wheres[self::criteria] = array_merge(
                $this->wheres[self::criteria],
                [$column => $value]
            );
        }

        return $this;
    }





    /**
     * @param ActiveRecordInterface $model
     * @return void
     * @throws NotFoundTableNameException
    */
    private function bootModel(ActiveRecordInterface $model): void
    {
        $this->model   = $model;
        $this->builder = $model->getConnection()->createQueryBuilder();
        $this->select  = $this->builder->select()->from($this->getTableName());
    }





    /**
     * @param WhereInterface $builder
     * @return WhereInterface
    */
    private function parseWheres(WhereInterface $builder): WhereInterface
    {
        foreach ($this->wheres as $method => $conditions) {
            if (in_array($method, [self::andWhere, self::orWhere])) {
                foreach ($conditions as $condition) {
                    $this->call($builder, $method, $condition);
                }
            } else {
                $this->call($builder, $method, $conditions);
            }
        }

        return $builder;
    }





    /**
     * @param object $object
     * @param string $method
     * @param $arguments
     * @return object
    */
    private function call(object $object, string $method, $arguments): object
    {
        if (is_callable([$object, $method])) {
            return call_user_func_array([$object, $method], [$arguments]);
        }

        return $object;
    }




    /**
     * @return QueryInterface
     */
    private function selectQuery(): QueryInterface
    {
        $this->parseWheres($this->select);

        return $this->select
                    ->setParameters($this->parameters)
                    ->getQuery()
                    ->map($this->getClassName());
    }





    /**
     * @param array $attributes
     * @return QueryInterface
     * @throws NotFoundTableNameException
    */
    private function insertQuery(array $attributes): QueryInterface
    {
        if ($this->model->hasTimestamps()) {
            $attributes = $this->mergeTimestamps($attributes);
        }

        return $this->builder->insert($this->getTableName())
                             ->values($attributes)
                             ->getQuery();
    }




    /**
     * @param array $attributes
     * @return QueryInterface
     * @throws NotFoundTableNameException
    */
    private function updateQuery(array $attributes): QueryInterface
    {
         $query = $this->builder->update($this->getTableName());

         foreach ($attributes as $column => $value) {
             $query->set($column, $value);
         }

         $this->parseWheres($query);

         return $query->setParameters($this->parameters)->getQuery();
    }






    /**
     * @return QueryInterface
     * @throws NotFoundTableNameException
    */
    private function deleteQuery(): QueryInterface
    {
         $query = $this->builder->delete($this->getTableName());

         $this->parseWheres($query);

         return $query->setParameters($this->parameters)->getQuery();
    }







    /**
     * @param array $attributes
     * @return array
    */
    private function mergeTimestamps(array $attributes): array
    {
        return array_merge($attributes, $this->model->getTimestamps());
    }
}