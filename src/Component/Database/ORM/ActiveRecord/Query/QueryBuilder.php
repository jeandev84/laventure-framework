<?php
declare(strict_types=1);

namespace Laventure\Component\Database\ORM\ActiveRecord\Query;

use Laventure\Component\Database\ORM\ActiveRecord\Contract\ActiveRecordInterface;
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
     * @var array|string[]
     */
    private array $operators = [
        '=',
        '>',
        '>=',
        '<',
        '>=',
        'like',
        'in'
    ];




    /**
     * @var array
    */
    protected array $wheres = [
        ConditionType::AND => [],
        ConditionType::OR  => []
    ];




    /**
     * @var array
    */
    protected array $parameters = [];





    /**
     * @param ActiveRecordInterface $model
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
        return $this->model->getClassName();
    }




    /**
     * @inheritDoc
    */
    public function getTableName(): string
    {
        return $this->model->getTableName();
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
    public function where(string $column, $value, string $operator = "="): static
    {
        return $this->andWhere($column, $value, $operator);
    }





    /**
     * @inheritDoc
    */
    public function andWhere(string $column, $value, string $operator = "="): static
    {
        return $this->criteria($column, $value, $operator, ConditionType::AND);
    }





    /**
     * @inheritDoc
    */
    public function orWhere(string $column, $value, string $operator = "="): static
    {
        return $this->criteria($column, $value, $operator, ConditionType::OR);
    }





    /**
     * @inheritDoc
    */
    public function whereLike(string $column, string $expression): static
    {
        return $this->where($column, $expression, 'like');
    }





    /**
     * @inheritDoc
    */
    public function whereIn(string $column, array $data): static
    {
        return $this->where($column, $data, 'in');
    }




    /**
     * @inheritDoc
    */
    public function create(array $attributes): int
    {
        return 0;
    }




    /**
     * @inheritDoc
    */
    public function update(array $attributes): int
    {

    }




    /**
     * @inheritDoc
    */
    public function delete(): bool
    {

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
    public function params(array $parameters): static
    {
         foreach ($parameters as $id => $value) {
             $this->param($id, $value);
         }

         return $this;
    }





    /**
     * @inheritDoc
    */
    public function param($id, $value): static
    {
        $this->parameters[$id] = $value;

        return $this;
    }





    /**
     * @return QueryInterface
    */
    private function selectQuery(): QueryInterface
    {
         return $this->select
                     ->setParameters($this->parameters)
                     ->getQuery()
                     ->map($this->getClassName());
    }







    /**
     * @param SQLBuilder $builder
     * @return SQLBuilder
    */
    private function parseWheres(SQLBuilder $builder): SQLBuilder
    {

    }






    /**
     * @param string $column
     * @param $value
     * @param string $operator
     * @param string $type
     * @return $this
    */
    private function criteria(string $column, $value, string $operator, string $type): static
    {
        $this->wheres[$type][$column] = sprintf('%s %s %s', $column, $operator, $value);

        return $this;
    }






    /**
     * @param ActiveRecordInterface $model
     * @return $this
    */
    private function bootModel(ActiveRecordInterface $model): static
    {
        $this->model   = $model;
        $this->builder = $model->getConnection()->createQueryBuilder();
        $this->select  = $this->builder->select()->from($this->getTableName());

        return $this;
    }
}