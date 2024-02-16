<?php
declare(strict_types=1);

namespace Laventure\Component\Database\Builder;

use Laventure\Component\Database\Builder\SQL\DML\Delete\DeleteBuilder;
use Laventure\Component\Database\Builder\SQL\DML\Delete\DeleteBuilderInterface;
use Laventure\Component\Database\Builder\SQL\DML\Insert\InsertBuilder;
use Laventure\Component\Database\Builder\SQL\DML\Insert\InsertSQlBuilderInterface;
use Laventure\Component\Database\Builder\SQL\DML\Update\UpdateBuilder;
use Laventure\Component\Database\Builder\SQL\DML\Update\UpdateBuilderInterface;
use Laventure\Component\Database\Builder\SQL\DQL\Select\SelectBuilder;
use Laventure\Component\Database\Builder\SQL\DQL\Select\SelectBuilderInterface;
use Laventure\Component\Database\Builder\SQL\Expr\Expr;
use Laventure\Component\Database\Builder\SQL\ExpressionInterface;
use Laventure\Component\Database\Builder\SQL\SQlBuilderInterface;
use Laventure\Component\Database\Connection\ConnectionInterface;


/**
 * SqlQueryBuilder
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\Builder
*/
class SqlQueryBuilder implements SqlQueryBuilderInterface
{
    /**
     * @var ConnectionInterface
    */
    protected ConnectionInterface $connection;


    /**
     * @var SQlBuilderInterface
    */
    protected SQlBuilderInterface $current;


    /**
     * @param ConnectionInterface $connection
    */
    public function __construct(ConnectionInterface $connection)
    {
        $this->connection = $connection;
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
    public function expr(): ExpressionInterface
    {
        return new Expr();
    }






    /**
     * @inheritDoc
    */
    public function select(string $selects = null): SelectBuilderInterface
    {
        $qb = new SelectBuilder($this->connection);
        return $this->current = $qb->select($selects ?: "*");
    }





    /**
     * @inheritDoc
    */
    public function insert(string $table): InsertSQlBuilderInterface
    {
        $qb = new InsertBuilder($this->connection);
        return $this->current = $qb->insert($table);
    }





    /**
     * @inheritDoc
    */
    public function update(string $table): UpdateBuilderInterface
    {
        $qb = new UpdateBuilder($this->connection);
        return $this->current = $qb->update($table);
    }





    /**
     * @inheritDoc
    */
    public function delete(string $table): DeleteBuilderInterface
    {
        $qb = new DeleteBuilder($this->connection);
        return $this->current = $qb->delete($table);
    }

    
    
    
    /**
     * @return SQlBuilderInterface
    */
    public function current(): SQlBuilderInterface
    {
        return $this->current;
    }
}
