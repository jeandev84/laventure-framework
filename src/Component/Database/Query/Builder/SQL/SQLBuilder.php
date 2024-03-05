<?php
declare(strict_types=1);

namespace Laventure\Component\Database\Query\Builder\SQL;

use Laventure\Component\Database\Connection\ConnectionInterface;
use Laventure\Component\Database\Query\Builder\SQL\Conditions\ConditionType;
use Laventure\Component\Database\Query\Builder\SQL\Criteria\Resolver\SQLCriteriaResolver;
use Laventure\Component\Database\Query\Builder\SQL\Criteria\Resolver\SQLCriteriaResolverInterface;
use Laventure\Component\Database\Query\Builder\SQL\Expr\Expr;
use Laventure\Component\Database\Query\Builder\SQL\Expr\ExpressionInterface;
use Laventure\Component\Database\Query\Builder\SQL\Formatter\SQLFormatter;
use Laventure\Component\Database\Query\Builder\SQL\Set\SettableResolver;
use Laventure\Component\Database\Query\Builder\SQL\Set\SettableResolverInterface;
use Laventure\Component\Database\Query\QueryInterface;
use Stringable;


/**
 * SQLBuilder
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\Query\Builder\SQL
*/
abstract class SQLBuilder implements SQLBuilderInterface
{

    /**
     * @var ConnectionInterface
    */
    protected ConnectionInterface $connection;




    /**
     * @var SQLCriteriaResolverInterface
    */
    protected SQLCriteriaResolverInterface $criteriaResolver;





    /**
     * @var SettableResolverInterface
    */
    protected SettableResolverInterface $settableResolver;






    /**
     * @var array
    */
    public array $set = [];




    /**
     * @var array
    */
    public array $wheres = [];





    /**
     * @var array
     */
    protected array $parameters = [];





    /**
     * @var array
    */
    protected array $bindParams = [];




    /**
     * @var array
    */
    protected array $bindValues = [];





    /**
     * @var array
    */
    protected array $bindColumns = [];







    /**
     * @param ConnectionInterface $connection
    */
    public function __construct(ConnectionInterface $connection)
    {
        $this->connection       = $connection;
        $this->criteriaResolver = new SQLCriteriaResolver($this);
        $this->settableResolver = new SettableResolver($this);
    }






    /**
     * @param SQLCriteriaResolverInterface $criteriaResolver
     * @return $this
    */
    public function addCriteriaResolver(SQLCriteriaResolverInterface $criteriaResolver): static
    {
        $this->criteriaResolver = $criteriaResolver;

        return $this;
    }




    /**
     * @param SettableResolverInterface $settableResolver
     * @return $this
    */
    public function addSetResolver(SettableResolverInterface $settableResolver): static
    {
        $this->settableResolver = $settableResolver;

        return $this;
    }






    /**
     * @param $column
     * @param $value
     * @return $this
    */
    public function set($column, $value): static
    {
        $this->set[$column] = $this->settableResolver
                                   ->resolve($column, $value);
        $this->setParameter($column, $value);

        return $this;
    }






    /**
     * @param $condition
     * @return $this
    */
    public function where($condition): static
    {
        return $this->addWhere($condition);
    }







    /**
     * @param $condition
     * @return $this
    */
    public function andWhere($condition): static
    {
        return $this->addWhere($condition, ConditionType::AND);
    }







    /**
     * @param $condition
     * @return $this
    */
    public function orWhere($condition): static
    {
        return $this->addWhere($condition, ConditionType::OR);
    }






    /**
     * @param $condition
     * @param $type
     * @return $this
    */
    public function addWhere($condition, $type = null): static
    {
        $this->wheres[$type ?: ConditionType::DEFAULT][] = $condition;

        return $this;
    }






    /**
     * @param $column
     * @param array $value
     * @return $this
    */
    public function whereIn($column, array $value): static
    {
        return $this->andWhere($this->expr()->in($column, $value));
    }






    /**
     * @param array $conditions
     * @return $this
    */
    public function criteria(array $conditions): static
    {
        foreach ($conditions as $column => $value) {
            if (is_array($value)) {
                $criteria = $this->criteriaResolver->resolveWhereIn($column, $value);
            } else {
                $criteria = $this->criteriaResolver->resolveWhereEqualTo($column, $value);
            }
            $this->andWhere($criteria->getCondition());
            $this->setParameter($criteria->getParam(), $criteria->getValue());
        }
        return $this;
    }






    /**
     * @return array
    */
    public function getWheres(): array
    {
        return $this->wheres;
    }





    /**
     * @inheritdoc
    */
    public function setParameter($id, $value): static
    {
        $this->parameters[$id] = $value;

        return $this;
    }






    /**
     * @inheritdoc
    */
    public function bindParam($id, $value, int $type = 0): static
    {
        $this->bindParams[$id] = [$id, $value, $type];

        return $this;
    }






    /**
     * @inheritdoc
    */
    public function bindValue($id, $value, int $type = 0): static
    {
        $this->bindValues[$id] = [$id, $value, $type];

        return $this;
    }




    /**
     * @inheritdoc
    */
    public function bindColumn($id, $value, int $type = 0): static
    {
        $this->bindColumns[$id] = [$id, $value, $type];

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
     * @inheritdoc
    */
    public function getParameters(): array
    {
        return $this->parameters;
    }





    /**
     * @inheritdoc
    */
    public function getQuery(): QueryInterface
    {
        return $this->connection
                    ->statement($this->getSQL())
                    ->setParameters($this->parameters)
                    ->bindParams($this->bindParams)
                    ->bindValues($this->bindValues)
                    ->bindColumns($this->bindColumns);
    }






    /**
     * @inheritdoc
    */
    public function getConnection(): ConnectionInterface
    {
        return $this->connection;
    }





    /**
     * @inheritdoc
    */
    public function getSQL(): string
    {
        return (new SQLFormatter())
               ->addFormats($this->getCommands())
               ->format();
    }







    /**
     * @inheritdoc
    */
    public function __toString(): string
    {
        return $this->getSQL();
    }





    /**
     * @inheritDoc
    */
    public function expr(): ExpressionInterface
    {
        return new Expr();
    }






    /**
     * @return Stringable[]
    */
    abstract protected function getCommands(): array;
}