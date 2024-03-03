<?php
declare(strict_types=1);

namespace Laventure\Component\Database\Query\Builder\SQL\Factory;

use Laventure\Component\Database\Connection\ConnectionInterface;
use Laventure\Component\Database\Query\Builder\SQL\DML\Delete\DeleteBuilder;
use Laventure\Component\Database\Query\Builder\SQL\DML\Delete\DeleteBuilderInterface;
use Laventure\Component\Database\Query\Builder\SQL\DML\Insert\InsertBuilder;
use Laventure\Component\Database\Query\Builder\SQL\DML\Insert\InsertBuilderInterface;
use Laventure\Component\Database\Query\Builder\SQL\DML\Update\UpdateBuilder;
use Laventure\Component\Database\Query\Builder\SQL\DML\Update\UpdateBuilderInterface;
use Laventure\Component\Database\Query\Builder\SQL\DQL\Select\SelectBuilder;
use Laventure\Component\Database\Query\Builder\SQL\DQL\Select\SelectBuilderInterface;
use Laventure\Component\Database\Query\Builder\SQL\Expr\Expr;
use Laventure\Component\Database\Query\Builder\SQL\Expr\ExpressionInterface;
use Laventure\Component\Database\Query\Builder\SQL\SQLBuilderInterface;

/**
 * SQLBuilderFactory
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\Builder\SQL
*/
class SQLBuilderFactory implements SQLBuilderFactoryInterface
{
    /**
     * @var ConnectionInterface
    */
    protected ConnectionInterface $connection;




    /**
     * @var SQLBuilderInterface
    */
    protected SQLBuilderInterface $builder;




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
    public function expr(): ExpressionInterface
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
