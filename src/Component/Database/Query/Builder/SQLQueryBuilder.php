<?php
declare(strict_types=1);

namespace Laventure\Component\Database\Query\Builder;

use Laventure\Component\Database\Connection\ConnectionInterface;
use Laventure\Component\Database\Query\Builder\Factory\SQLBuilderFactory;
use Laventure\Component\Database\Query\Builder\SQL\DML\Delete\DeleteBuilderInterface;
use Laventure\Component\Database\Query\Builder\SQL\DML\Insert\InsertBuilderInterface;
use Laventure\Component\Database\Query\Builder\SQL\DML\Update\UpdateBuilderInterface;
use Laventure\Component\Database\Query\Builder\SQL\DQL\Select\SelectBuilderInterface;
use Laventure\Component\Database\Query\Builder\SQL\Expr\ExpressionInterface;

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
    protected SQLBuilderFactory $factory;


    /**
     * @param ConnectionInterface $connection
    */
    public function __construct(ConnectionInterface $connection)
    {
        $this->factory = new SQLBuilderFactory($connection);
    }




    /**
     * @inheritDoc
    */
    public function expr(): ExpressionInterface
    {
        return $this->factory->expr();
    }






    /**
     * @inheritDoc
    */
    public function select(string $selects = null): SelectBuilderInterface
    {
        return $this->factory
                    ->createSelectBuilder()
                    ->select($selects ?: "*");
    }





    /**
     * @inheritDoc
    */
    public function insert(string $table): InsertBuilderInterface
    {
        return $this->factory
                    ->createInsertBuilder()
                    ->insert($table);
    }





    /**
     * @inheritDoc
    */
    public function update(string $table): UpdateBuilderInterface
    {
        return $this->factory
                    ->createUpdateBuilder()
                    ->update($table);
    }





    /**
     * @inheritDoc
    */
    public function delete(string $table): DeleteBuilderInterface
    {
        return $this->factory
                    ->createDeleteBuilder()
                    ->delete($table);
    }
}
