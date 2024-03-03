<?php
declare(strict_types=1);

namespace Laventure\Component\Database\Query\Builder\Common;

use Laventure\Component\Database\Connection\ConnectionInterface;
use Laventure\Component\Database\Query\Builder\QueryBuilderInterface;
use Laventure\Component\Database\Query\Builder\SQL\Conditions\SQLConditionBuilder;
use Laventure\Component\Database\Query\Builder\SQL\Conditions\Where\WhereInterface;
use Laventure\Component\Database\Query\Builder\SQL\DML\Delete\DeleteBuilderInterface;
use Laventure\Component\Database\Query\Builder\SQL\DML\Insert\InsertBuilderInterface;
use Laventure\Component\Database\Query\Builder\SQL\DML\Update\UpdateBuilderInterface;
use Laventure\Component\Database\Query\Builder\SQL\DQL\Select\SelectBuilderInterface;
use Laventure\Component\Database\Query\Builder\SQL\Expr\ExpressionInterface;
use Laventure\Component\Database\Query\Builder\SQL\Factory\SQLBuilderFactory;
use Laventure\Component\Database\Query\Builder\SQL\SQLBuilderInterface;
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
    private const SELECT = 'select';
    private const INSERT = 'insert';
    private const UPDATE = 'update';
    private const DELETE = 'delete';

    protected string $state = self::SELECT;
    protected ConnectionInterface $connection;
    protected SQLBuilderFactory $factory;
    protected SelectBuilderInterface $select;
    protected InsertBuilderInterface $insert;
    protected UpdateBuilderInterface $update;
    protected DeleteBuilderInterface $delete;


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
        $this->factory    = new SQLBuilderFactory($connection);
        $this->select     = $this->factory->createSelectBuilder();
        $this->insert     = $this->factory->createInsertBuilder();
        $this->update     = $this->factory->createUpdateBuilder();
        $this->delete     = $this->factory->createDeleteBuilder();
        $this->connection = $connection;
    }




    /**
     * @inheritDoc
    */
    public function expr(): ExpressionInterface
    {
        return $this->factory->expr();
    }




    /**
     * @inheritDoc
    */
    public function select(string $columns = null): static
    {
        $this->selectQuery()->select($columns ?: "*");

        return $this;
    }




    /**
     * @inheritdoc
    */
    public function distinct(bool $distinct): static
    {
        $this->selectQuery()->distinct($distinct);

        return $this;
    }





    /**
     * @inheritDoc
    */
    public function addSelect(string $columns): static
    {
        $this->selectQuery()->addSelect($columns);

        return $this;
    }






    /**
     * @inheritDoc
    */
    public function from(string $from, string $alias = ''): static
    {
        $this->selectQuery()->from($from, $alias);

        return $this;
    }







    /**
     * @inheritDoc
    */
    public function join(string $table, string $condition): static
    {
        $this->selectQuery()->join($table, $condition);

        return $this;
    }




    /**
     * @inheritDoc
    */
    public function leftJoin(string $table, string $condition): static
    {
        $this->selectQuery()->leftJoin($table, $condition);

        return $this;
    }




    /**
     * @inheritDoc
    */
    public function rightJoin(string $table, string $condition): static
    {
        $this->selectQuery()->rightJoin($table, $condition);

        return $this;
    }




    /**
     * @inheritDoc
    */
    public function innerJoin(string $table, string $condition): static
    {
        $this->selectQuery()->innerJoin($table, $condition);

        return $this;
    }




    /**
     * @inheritDoc
    */
    public function fullJoin(string $table, string $condition): static
    {
        $this->selectQuery()->fullJoin($table, $condition);

        return $this;
    }




    /**
     * @inheritDoc
    */
    public function addJoin(string $join): static
    {
        $this->selectQuery()->addJoin($join);

        return $this;
    }




    /**
     * @inheritDoc
    */
    public function groupBy(string $columns): static
    {
        $this->selectQuery()->groupBy($columns);

        return $this;
    }





    /**
     * @inheritDoc
    */
    public function addGroupBy(string $columns): static
    {
        $this->selectQuery()->addGroupBy($columns);

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
        $this->selectQuery()->orderBy($column, $direction ?: 'ASC');

        return $this;
    }






    /**
     * @inheritDoc
    */
    public function addOrderBy(array $orders): static
    {
        $this->selectQuery()->addOrderBy($orders);

        return $this;
    }




    /**
     * @inheritDoc
    */
    public function limit($limit): static
    {
        $this->selectQuery()->limit($limit);

        return $this;
    }




    /**
     * @inheritDoc
    */
    public function offset($offset): static
    {
        $this->selectQuery()->offset($offset);

        return $this;
    }




    /**
     * @inheritDoc
    */
    public function insert(string $table): static
    {
        $this->insertQuery()->insert($table);

        return $this;
    }




    /**
     * @inheritDoc
    */
    public function values(array $values): static
    {
        if (isset($values[0])) {
            $this->resolveMultipleInsert($values);
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
        $this->insertQuery()->setValue($column, $value, $index);

        return $this;
    }




    /**
     * @inheritDoc
    */
    public function update(string $table, string $alias = ''): static
    {
        $this->updateQuery()->update($table ? "$table $alias" : $table);

        return $this;
    }





    /**
     * @inheritDoc
    */
    public function set(string $column, $value): static
    {
        $this->updateQuery()->set($column, $value);

        return $this;
    }





    /**
     * @inheritDoc
    */
    public function delete(string $table, string $alias = ''): static
    {
        $this->deleteQuery()->delete($table ? "$table $alias" : $table);

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
            [$param, $value, $condition] = $this->resolveCriteria($column, $value);
            $this->andWhere($condition);
            $this->setParameter($param, $value);
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
     * @return ConnectionInterface
    */
    public function getConnection(): ConnectionInterface
    {
        return $this->connection;
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
        $statement->setParameters($this->parameters);
        $statement->bindValues($this->bindingValues);
        $statement->bindParams($this->bindingParams);
        return $statement;
    }




    /**
     * @inheritdoc
    */
    public function clear(): void
    {
         //TODO Implements
    }




    /**
     * @return SQLBuilderInterface
    */
    private function getBuilder(): SQLBuilderInterface
    {
        $builder  = $this->getCurrentBuilder();

        if ($builder instanceof SelectBuilderInterface) {
            $builder = $this->buildHaving($builder);
        }

        if ($builder instanceof WhereInterface) {
            $builder = $this->buildWheres($builder);
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
     * @return SelectBuilderInterface
    */
    private function buildHaving(SelectBuilderInterface $builder): SelectBuilderInterface
    {
        $conditionBuilder = new SQLConditionBuilder($this->having);

        if (!$conditionBuilder->empty()) {
            $builder->having($conditionBuilder->build());
        }

        return $builder;
    }





    /**
     * @param WhereInterface $builder
     * @return WhereInterface
    */
    private function buildWheres(WhereInterface $builder): WhereInterface
    {
        $conditionBuilder = new SQLConditionBuilder($this->wheres);

        if (!$conditionBuilder->empty()) {
            $builder->where($conditionBuilder->build());
        }

        return $builder;
    }


    
    
    
    /**
     * @return SelectBuilderInterface
    */
    private function selectQuery(): SelectBuilderInterface
    {
        $this->state = self::SELECT;

        return $this->select;
    }


    
    
    /**
     * @return InsertBuilderInterface
    */
    private function insertQuery(): InsertBuilderInterface
    {
        $this->state = self::INSERT;

        return $this->insert;
    }





    /**
     * @return UpdateBuilderInterface
    */
    private function updateQuery(): UpdateBuilderInterface
    {
        $this->state = self::UPDATE;

        return $this->update;
    }






    /**
     * @return DeleteBuilderInterface
    */
    private function deleteQuery(): DeleteBuilderInterface
    {
        $this->state = self::DELETE;

        return $this->delete;
    }






    /**
     * @return SQLBuilderInterface
    */
    private function getCurrentBuilder(): SQLBuilderInterface
    {
        return match ($this->state) {
            self::SELECT => $this->select,
            self::INSERT => $this->insert,
            self::UPDATE => $this->update,
            self::DELETE => $this->delete
        };
    }






    /**
     * @param array $values
     * @return $this
    */
    abstract protected function resolveMultipleInsert(array $values): static;






    /**
     * @param array $values
     * @return $this
    */
    abstract protected function resolveInsert(array $values): static;





    /**
     * @param string $column
     * @param $value
     * @return array
    */
    abstract protected function resolveCriteria(string $column, $value): array;
}
