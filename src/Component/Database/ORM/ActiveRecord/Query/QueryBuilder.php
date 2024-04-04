<?php

declare(strict_types=1);

namespace Laventure\Component\Database\ORM\ActiveRecord\Query;

use Laventure\Component\Database\ORM\ActiveRecord\Contract\ActiveRecordInterface;
use Laventure\Component\Database\ORM\ActiveRecord\Exception\NotFoundTableNameException;
use Laventure\Component\Database\Query\Builder\QueryBuilderInterface;
use Laventure\Component\Database\Query\Pagination\Pagination;
use Laventure\Component\Database\Query\QueryInterface;
use Laventure\Component\Database\Query\Builder\SQL\Expr\ExpressionBuilderInterface;
use function _PHPStan_3d4486d07\React\Promise\map;

/**
 * PdoQueryBuilder
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\ORM\ActiveRecord\Statement
*/
class QueryBuilder implements Builder
{

    /**
     * @var ActiveRecordInterface
    */
    protected ActiveRecordInterface $model;



    /**
     * @var QueryBuilderInterface
    */
    protected QueryBuilderInterface $builder;




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
        $this->builder->select(...$columns);

        return $this;
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
    public function from(string $from, string $alias = ''): static
    {
        $this->builder->from($from, $alias);

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
    public function orderBy(string $column, string $direction = null): static
    {
        $this->builder->orderBy($column, $direction ?: 'ASC');

        return $this;
    }





    /**
     * @inheritDoc
    */
    public function groupBy(string $column): static
    {
        $this->builder->groupBy($column);

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
    public function limit(int $limit): static
    {
        $this->builder->limit($limit);

        return $this;
    }





    /**
     * @inheritDoc
    */
    public function offset(int $offset): static
    {
        $this->builder->offset($offset);

        return $this;
    }






    /**
     * @inheritDoc
    */
    public function where(string $condition): static
    {
        $this->builder->where($condition);

        return $this;
    }





    /**
     * @inheritDoc
    */
    public function andWhere(string $condition): static
    {
        $this->builder->andWhere($condition);

        return $this;
    }





    /**
     * @inheritDoc
    */
    public function orWhere(string $condition): static
    {
        $this->builder->orWhere($condition);

        return $this;
    }





    /**
     * @inheritDoc
    */
    public function criteria(array $criteria): static
    {
        $this->builder->criteria($criteria);

        return $this;
    }





    /**
     * @inheritDoc
     * @throws NotFoundTableNameException
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
     * @return mixed
    */
    public function one(): mixed
    {
        return $this->builder
                    ->getQuery()
                    ->fetch()
                    ->one();
    }




    /**
     * @inheritDoc
     * @return array
    */
    public function get(): array
    {
        return $this->builder
                    ->getQuery()
                    ->fetch()
                    ->all();
    }





    /**
     * @inheritDoc
     * @return array
    */
    public function assoc(): array
    {
        return $this->builder
                    ->getQuery()
                    ->fetch()
                    ->assoc();
    }






    /**
     * @inheritDoc
    */
    public function columns(): array
    {
        return $this->builder
                    ->getQuery()
                    ->fetch()
                    ->columns();
    }






    /**
     * @inheritDoc
    */
    public function first(): mixed
    {
        return $this->builder
                    ->getQuery()
                    ->fetch()
                    ->first();
    }





    /**
     * @inheritDoc
    */
    public function count(): int
    {
        return $this->builder
                    ->getQuery()
                    ->fetch()
                    ->count();
    }






    /**
     * @inheritDoc
     * @param int $page
     * @param int $limit
     * @return array
    */
    public function paginate(int $page, int $limit): array
    {
        $pagination = new Pagination($this->builder, $page, $limit);

        return $pagination->getItems();
    }







    /**
     * @inheritDoc
    */
    public function params(array $parameters): static
    {
        $this->builder->setParameters($parameters);

        return $this;
    }





    /**
     * @inheritDoc
    */
    public function param($id, $value): static
    {
        $this->builder->setParameter($id, $value);

        return $this;
    }




    /**
     * @inheritDoc
     * @throws NotFoundTableNameException
    */
    public function find($id): mixed
    {
        return $this->select()
                    ->criteria([$this->getPrimaryKey() => $id])
                    ->one();
    }





    /**
     * @inheritDoc
     * @throws NotFoundTableNameException
    */
    public function all(): array
    {
         return $this->select()->get();
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
    public function getParameters(): array
    {
        return $this->builder->getQuery()->getParameters();
    }






    /**
     * @return QueryInterface
     * @throws NotFoundTableNameException
    */
    private function selectQuery(): QueryInterface
    {
        return $this->builder
                    ->from($this->getTableName())
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
        if ($this->hasTimestamps()) {
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
        $this->builder->update($this->getTableName());
        $updatedAt = $this->model->getUpdatedAt();

        if ($this->hasTimestamps()) {
            $attributes[$updatedAt] = date('Y-m-d H:i:s');
        }

        foreach ($attributes as $column => $value) {
            $this->builder->set($column, $value);
        }

        return $this->builder->getQuery();
    }






    /**
     * @return QueryInterface
     * @throws NotFoundTableNameException
    */
    private function deleteQuery(): QueryInterface
    {
        $this->builder->delete($this->getTableName());

        return $this->builder->getQuery();
    }






    /**
     * @return bool
    */
    private function hasTimestamps(): bool
    {
        return $this->model->hasTimestamps();
    }




    /**
     * @param array $attributes
     * @return array
    */
    private function mergeTimestamps(array $attributes): array
    {
        return array_merge($attributes, $this->model->getTimestamps());
    }






    /**
     * @param ActiveRecordInterface $model
     * @return void
     * @throws NotFoundTableNameException
    */
    private function bootModel(ActiveRecordInterface $model): void
    {
        $this->model   = $model;
        $this->bootQueryBuilder($model);
    }






    /**
     * @throws NotFoundTableNameException
    */
    private function bootQueryBuilder(ActiveRecordInterface $model): void
    {
        $this->builder = $model->getConnection()->createQueryBuilder();
        $this->builder->select()->from($this->getTableName())->map($this->getClassName());
    }
}
