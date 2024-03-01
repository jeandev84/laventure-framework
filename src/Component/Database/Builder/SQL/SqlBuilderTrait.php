<?php

declare(strict_types=1);

namespace Laventure\Component\Database\Builder\SQL;

use Laventure\Component\Database\Builder\SQL\Expr\Expr;
use Laventure\Component\Database\Builder\SQL\Expr\ExpressionInterface;
use Laventure\Component\Database\Builder\SQL\Formatter\QueryFormatter;
use Laventure\Component\Database\Connection\ConnectionInterface;
use Laventure\Component\Database\Query\QueryInterface;
use Stringable;

/**
 * SqlBuilderTrait
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\Builder\SQL
 */
trait SqlBuilderTrait
{
    /**
     * @var ConnectionInterface
    */
    protected ConnectionInterface $connection;





    /**
     * @param ConnectionInterface $connection
    */
    public function __construct(ConnectionInterface $connection)
    {
        $this->connection = $connection;
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
        return new Expr();
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
    public function getSQL(): string
    {
        return (new QueryFormatter())
               ->addFormats($this->getCommands())
               ->format();
    }




    /**
     * @return Stringable[]
    */
    abstract public function getCommands(): array;
}
