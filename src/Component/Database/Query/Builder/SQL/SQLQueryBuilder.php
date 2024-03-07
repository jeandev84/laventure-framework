<?php

declare(strict_types=1);

namespace Laventure\Component\Database\Query\Builder\SQL;

use Laventure\Component\Database\Connection\ConnectionInterface;
use Laventure\Component\Database\Query\Builder\SQL\DML\Delete\DeleteBuilderInterface;
use Laventure\Component\Database\Query\Builder\SQL\DML\Insert\InsertBuilderInterface;
use Laventure\Component\Database\Query\Builder\SQL\DML\Update\UpdateBuilderInterface;
use Laventure\Component\Database\Query\Builder\SQL\DQL\Select\SelectBuilderInterface;
use Laventure\Component\Database\Query\Builder\SQL\Expr\ExpressionBuilderInterface;
use Laventure\Component\Database\Query\Builder\SQL\Expr\Factory\ExpressionBuilderFactory;
use Laventure\Component\Database\Query\Builder\SQL\Factory\SQLBuilderFactory;

/**
 * SQLQueryBuilder
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\Builder\SQL
*/
class SQLQueryBuilder implements SQLQueryBuilderInterface
{
    protected ConnectionInterface $connection;


    /**
     * @var SQLBuilderFactory
    */
    protected SQLBuilderFactory $builderFactory;


    /**
     * @var ExpressionBuilderFactory
    */
    protected ExpressionBuilderFactory $expressionFactory;



    /**
     * @param ConnectionInterface $connection
    */
    public function __construct(ConnectionInterface $connection)
    {
        $this->connection        = $connection;
        $this->builderFactory    = new SQLBuilderFactory($connection);
        $this->expressionFactory = new ExpressionBuilderFactory();
    }




    /**
     * @inheritDoc
    */
    public function expr(): ExpressionBuilderInterface
    {
        return $this->expressionFactory
                    ->createExpressionBuilder();
    }






    /**
     * @inheritDoc
    */
    public function select(string $selects = null): SelectBuilderInterface
    {
        return $this->builderFactory
                    ->createSelectBuilder()
                    ->select($selects ?: "*");
    }





    /**
     * @inheritDoc
    */
    public function insert(string $table): InsertBuilderInterface
    {
        return $this->builderFactory
                    ->createInsertBuilder()
                    ->insert($table);
    }





    /**
     * @inheritDoc
    */
    public function update(string $table): UpdateBuilderInterface
    {
        return $this->builderFactory
                    ->createUpdateBuilder()
                    ->update($table);
    }





    /**
     * @inheritDoc
    */
    public function delete(string $table): DeleteBuilderInterface
    {
        return $this->builderFactory
                    ->createDeleteBuilder()
                    ->delete($table);
    }
}
