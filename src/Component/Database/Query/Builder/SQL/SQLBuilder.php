<?php

declare(strict_types=1);

namespace Laventure\Component\Database\Query\Builder\SQL;

use Laventure\Component\Database\Connection\ConnectionInterface;
use Laventure\Component\Database\Query\Builder\SQL\Conditions\ConditionType;
use Laventure\Component\Database\Query\Builder\SQL\Conditions\Where\WhereInterface;
use Laventure\Component\Database\Query\Builder\SQL\Criteria\Criteria;
use Laventure\Component\Database\Query\Builder\SQL\Criteria\CriteriaInterface;
use Laventure\Component\Database\Query\Builder\SQL\Expr\ExpressionBuilderInterface;
use Laventure\Component\Database\Query\Builder\SQL\Expr\Factory\ExpressionBuilderFactory;
use Laventure\Component\Database\Query\Builder\SQL\Formatter\SQLFormatter;
use Laventure\Component\Database\Query\Builder\SQL\Set\SettableInterface;
use Laventure\Component\Database\Query\QueryInterface;
use Stringable;

/**
 * SQLBuilder
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\Statement\Builder\SQL
*/
abstract class SQLBuilder implements WhereInterface, SQLBuilderInterface, SettableInterface
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
     * @return string
    */
    public function eq($column, $value): string
    {
        return strval($this->expr()->eq($column, $value));
    }





    /**
     * @inheritdoc
    */
    public function set($column, $value): static
    {
        $this->criteria->set[$column] = $this->eq($column, $value);

        return $this;
    }







    /**
     * @inheritdoc
    */
    public function where($condition): static
    {
        return $this->addWhere($condition);
    }







    /**
     * @inheritdoc
    */
    public function andWhere($condition): static
    {
        return $this->addWhere($condition, ConditionType::AND);
    }







    /**
     * @inheritdoc
    */
    public function orWhere($condition): static
    {
        return $this->addWhere($condition, ConditionType::OR);
    }






    /**
     * @inheritdoc
    */
    public function addWhere($condition, $type = null): static
    {
        $this->criteria->wheres[$type ?: ConditionType::DEFAULT][] = $condition;

        return $this;
    }






    /**
     * @inheritdoc
    */
    public function whereIn($column, array $value): static
    {
        return $this->andWhere($this->expr()->in($column, $value));
    }







    /**
     * @inheritdoc
    */
    public function whereEqualTo($column, $value): static
    {
        return $this->andWhere($this->eq($column, $value));
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
        $this->criteria->parameters[$id] = $value;

        return $this;
    }






    /**
     * @inheritdoc
    */
    public function bindParam($id, $value, int $type = 0): static
    {
        $this->criteria->bindParams[$id] = [$id, $value, $type];

        return $this;
    }






    /**
     * @inheritdoc
    */
    public function bindValue($id, $value, int $type = 0): static
    {
        $this->criteria->bindValues[$id] = [$id, $value, $type];

        return $this;
    }




    /**
     * @inheritdoc
    */
    public function bindColumn($id, $value, int $type = 0): static
    {
        $this->criteria->bindColumns[$id] = [$id, $value, $type];

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
        foreach ($parameters as $column => $value) {
            $this->setParameter($column, $value);
        }

        return $this;
    }






    /**
     * @inheritdoc
    */
    public function getParameters(): array
    {
        return $this->criteria->parameters;
    }





    /**
     * @inheritDoc
     */
    public function getBindingParams(): array
    {
        return $this->criteria->bindParams;
    }



    /**
     * @inheritDoc
     */
    public function getBindingValues(): array
    {
        return $this->criteria->bindValues;
    }




    /**
     * @inheritDoc
    */
    public function getBindingColumns(): array
    {
        return $this->criteria->bindColumns;
    }





    /**
     * @inheritdoc
    */
    public function getQuery(): QueryInterface
    {
        return $this->connection
                    ->statement($this->getSQL())
                    ->setParameters($this->criteria->parameters)
                    ->bindParams($this->criteria->bindParams)
                    ->bindValues($this->criteria->bindValues)
                    ->bindColumns($this->criteria->bindColumns);
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
        return $this->expressionFactory->create();
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
