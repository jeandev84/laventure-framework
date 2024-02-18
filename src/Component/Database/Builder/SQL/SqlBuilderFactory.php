<?php

declare(strict_types=1);

namespace Laventure\Component\Database\Builder\SQL;

use Laventure\Component\Database\Builder\SQL\DML\Delete\DeleteBuilder;
use Laventure\Component\Database\Builder\SQL\DML\Delete\DeleteBuilderInterface;
use Laventure\Component\Database\Builder\SQL\DML\Insert\InsertBuilder;
use Laventure\Component\Database\Builder\SQL\DML\Insert\InsertBuilderInterface;
use Laventure\Component\Database\Builder\SQL\DML\Update\UpdateBuilder;
use Laventure\Component\Database\Builder\SQL\DML\Update\UpdateBuilderInterface;
use Laventure\Component\Database\Builder\SQL\DQL\Select\SelectBuilder;
use Laventure\Component\Database\Builder\SQL\DQL\Select\SelectBuilderInterface;
use Laventure\Component\Database\Builder\SQL\Expr\Expr;
use Laventure\Component\Database\Connection\ConnectionInterface;

/**
 * SqlBuilderFactory
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\Builder\SQL
*/
class SqlBuilderFactory
{
    /**
     * @var ConnectionInterface
    */
    protected ConnectionInterface $connection;




    /**
     * @var SQlBuilderInterface
    */
    protected SQlBuilderInterface $builder;




    /**
     * @param ConnectionInterface $connection
    */
    public function __construct(ConnectionInterface $connection)
    {
        $this->connection = $connection;
    }





    /**
     * @return ExpressionInterface
    */
    public function createExpr(): ExpressionInterface
    {
        return new Expr();
    }




    /**
     * @return SelectBuilderInterface
    */
    public function createSelect(): SelectBuilderInterface
    {
        return new SelectBuilder($this->connection);
    }





    /**
     * @return InsertBuilderInterface
    */
    public function createInsert(): InsertBuilderInterface
    {
        return new InsertBuilder($this->connection);
    }




    /**
     * @return UpdateBuilderInterface
    */
    public function createUpdate(): UpdateBuilderInterface
    {
        return new UpdateBuilder($this->connection);
    }





    /**
     * @return DeleteBuilderInterface
    */
    public function createDelete(): DeleteBuilderInterface
    {
        return new DeleteBuilder($this->connection);
    }
}
