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
use Laventure\Component\Database\Builder\SQL\Expr\ExpressionInterface;
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
class SqlBuilderFactory implements SqlBuilderFactoryInterface
{
    /**
     * @var ConnectionInterface
    */
    protected ConnectionInterface $connection;




    /**
     * @var SqlBuilderInterface
    */
    protected SqlBuilderInterface $builder;




    /**
     * @param ConnectionInterface $connection
    */
    public function __construct(ConnectionInterface $connection)
    {
        $this->connection = $connection;
    }





    /**
     * @inheritdoc
    */
    public function createExpressionBuilder(): ExpressionInterface
    {
        return new Expr();
    }




    /**
     * @inheritdoc
    */
    public function createSelectBuilder(): SelectBuilderInterface
    {
        return new SelectBuilder($this->connection);
    }





    /**
     * @inheritdoc
    */
    public function createInsertBuilder(): InsertBuilderInterface
    {
        return new InsertBuilder($this->connection);
    }




    /**
     * @inheritdoc
    */
    public function createUpdateBuilder(): UpdateBuilderInterface
    {
        return new UpdateBuilder($this->connection);
    }





    /**
     * @inheritdoc
    */
    public function createDeleteBuilder(): DeleteBuilderInterface
    {
        return new DeleteBuilder($this->connection);
    }
}
