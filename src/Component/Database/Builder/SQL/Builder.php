<?php
declare(strict_types=1);

namespace Laventure\Component\Database\Builder\SQL;

use Laventure\Component\Database\Builder\SQL\Criteria\Criteria;
use Laventure\Component\Database\Builder\SQL\Expr\Expr;
use Laventure\Component\Database\Builder\SQL\Expr\Where;
use Laventure\Component\Database\Builder\SQL\Formatter\SQlFormatter;
use Laventure\Component\Database\Connection\ConnectionInterface;
use Laventure\Component\Database\Query\QueryInterface;

/**
 * Builder
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\Builder\SQL
 */
abstract class Builder implements BuilderInterface
{
    /**
     * @var ConnectionInterface
    */
    protected ConnectionInterface $connection;


    /**
     * @var SQlFormatter
     */
    protected SQlFormatter $formatter;


    /**
     * @var ExpressionInterface
     */
    protected ExpressionInterface $expr;




    /**
     * @var Criteria
     */
    protected Criteria $criteria;



    /**
     * @param ConnectionInterface $connection
     */
    public function __construct(ConnectionInterface $connection)
    {
        $this->connection = $connection;
        $this->criteria   = new Criteria();
        $this->expr       = new Expr();
        $this->formatter  = new SQlFormatter();
    }





    /**
     * @param string $condition
     * @return $this
     */
    public function where(string $condition): static
    {
        return $this->andWhere($condition);
    }





    /**
     * @param string $condition
     * @return $this
     */
    public function andWhere(string $condition): static
    {
        $this->criteria->wheres['AND'][] = $condition;

        return $this;
    }






    /**
     * @param string $condition
     * @return $this
     */
    public function orWhere(string $condition): static
    {
        $this->criteria->wheres['OR'][] = $condition;

        return $this;
    }





    /**
     * @return array
     */
    public function getConditions(): array
    {
        return $this->criteria->wheres;
    }




    /**
     * @return Where
     */
    public function getWhere(): Where
    {
        return new Where($this->getConditions());
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
            $this->criteria->parameters, $parameters
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
     * @return QueryInterface
     */
    public function getQuery(): QueryInterface
    {
        $statement = $this->connection->statement($this->getSQL());
        $statement->bindParams($this->getBindingParams());
        $statement->bindValues($this->getBindingValues());
        return $statement->withParams($this->getParameters());
    }






    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->getSQL();
    }





    /**
     * @return Expr
     */
    public function expr(): ExpressionInterface
    {
        return $this->expr;
    }




    /**
     * @return Criteria
     */
    public function getCriteria(): Criteria
    {
        return $this->criteria;
    }





    /**
     * @return array
     */
    public function getBindingParams(): array
    {
        return $this->criteria->bindingParams;
    }





    /**
     * @return array
     */
    public function getBindingValues(): array
    {
        return $this->criteria->bindingValues;
    }




    /**
     * @return ConnectionInterface
    */
    public function getConnection(): ConnectionInterface
    {
        return $this->connection;
    }
}