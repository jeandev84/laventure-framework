<?php

declare(strict_types=1);

namespace Laventure\Component\Database\Builder\SQL;

use Laventure\Component\Database\Builder\SQL\Criteria\Criteria;
use Laventure\Component\Database\Builder\SQL\Expr\Expr;
use Laventure\Component\Database\Builder\SQL\Formatter\SQlFormatter;
use Laventure\Component\Database\Connection\ConnectionInterface;
use Laventure\Component\Database\Query\QueryInterface;

/**
 * SQlBuilderTrait
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\Builder\SQL
 */
trait SQlBuilderTrait
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
     * @param Criteria $criteria
     * @return $this
    */
    public function criteria(Criteria $criteria): static
    {
        $this->criteria = $criteria;

        return $this;
    }





    /**
     * @return QueryInterface
    */
    public function getQuery(): QueryInterface
    {
        return $this->connection->statement($this->getSQL());

        /*
        $statement->bindParams($this->getBindingParams());
        $statement->bindValues($this->getBindingValues());
        return $statement->setParameters($this->getParameters());
        */
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
     * @return ConnectionInterface
    */
    public function getConnection(): ConnectionInterface
    {
        return $this->connection;
    }




    /**
     * @return string
    */
    abstract public function getSQL(): string;
}
