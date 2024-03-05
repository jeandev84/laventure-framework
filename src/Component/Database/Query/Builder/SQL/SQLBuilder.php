<?php
declare(strict_types=1);

namespace Laventure\Component\Database\Query\Builder\SQL;

use Laventure\Component\Database\Connection\ConnectionInterface;
use Laventure\Component\Database\Query\Builder\SQL\Conditions\ConditionType;
use Laventure\Component\Database\Query\Builder\SQL\Conditions\Criteria\Resolver\SQLCriteriaResolver;
use Laventure\Component\Database\Query\Builder\SQL\Conditions\Criteria\Resolver\SQLCriteriaResolverInterface;
use Laventure\Component\Database\Query\Builder\SQL\Conditions\Where\WhereInterface;
use Laventure\Component\Database\Query\Builder\SQL\Criteria\Criteria;
use Laventure\Component\Database\Query\Builder\SQL\Criteria\CriteriaInterface;
use Laventure\Component\Database\Query\Builder\SQL\Expr\ExpressionBuilderInterface;
use Laventure\Component\Database\Query\Builder\SQL\Expr\Factory\ExpressionBuilderFactory;
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
abstract class SQLBuilder implements WhereInterface, SQLBuilderInterface, SettableResolverInterface
{

    /**
     * @var ConnectionInterface
    */
    protected ConnectionInterface $connection;





    /**
     * @var ExpressionBuilderFactory
    */
    protected ExpressionBuilderFactory $expressionFactory;





    /**
     * @var Criteria
    */
    protected Criteria $criteria;





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
        $this->connection        = $connection;
        $this->criteria          = new Criteria();
        $this->expressionFactory = new ExpressionBuilderFactory();
    }





    /**
     * @param $column
     * @param $value
     * @return $this
    */
    public function set($column, $value): static
    {
        $this->criteria->set[$column] = $this->resolveSet($column, $value);

        return $this;
    }




    /**
     * @inheritDoc
    */
    public function resolveSet($column, $value): string
    {
        return strval($this->expr()->eq($column, $value));
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
        $this->criteria->wheres[$type ?: ConditionType::DEFAULT][] = $condition;

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
     * @param $column
     * @param $value
     * @return $this
    */
    public function whereEqualTo($column, $value): static
    {
         return $this->andWhere($this->expr()->eq($column, $value));
    }







    /**
     * @param array $conditions
     * @return $this
    */
    public function criteria(array $conditions): static
    {
        foreach ($conditions as $column => $value) {
            if (is_array($value)) {
                $this->whereIn($column, $value);
            } else {
                $this->whereEqualTo($column, $value);
            }
        }
        return $this;
    }






    /**
     * @return array
    */
    public function getWheres(): array
    {
        return $this->criteria->wheres;
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
    public function expr(): ExpressionBuilderInterface
    {
        return $this->expressionFactory->createExpressionBuilder();
    }





    /**
     * @inheritDoc
    */
    public function getCriteria(): CriteriaInterface
    {
        return $this->criteria;
    }






    /**
     * @return Stringable[]
    */
    abstract protected function getCommands(): array;
}