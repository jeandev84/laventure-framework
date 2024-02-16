<?php
declare(strict_types=1);

namespace Laventure\Component\Database\Builder;

use Laventure\Component\Database\Builder\SQL\DML\Delete\DeleteBuilderInterface;
use Laventure\Component\Database\Builder\SQL\DML\Insert\InsertBuilderInterface;
use Laventure\Component\Database\Builder\SQL\DML\Update\UpdateBuilderInterface;
use Laventure\Component\Database\Builder\SQL\DQL\Select\SelectBuilderInterface;
use Laventure\Component\Database\Builder\SQL\ExpressionInterface;
use Laventure\Component\Database\Builder\SQL\SqlBuilderFactory;
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

    protected SqlBuilderFactory $factory;


    /**
     * @param ConnectionInterface $connection
    */
    public function __construct(ConnectionInterface $connection)
    {
        $this->factory = new SqlBuilderFactory($connection);
    }




    /**
     * @return ConnectionInterface
    */
    public function getConnection(): ConnectionInterface
    {
        return $this->factory->getConnection();
    }




    /**
     * @inheritDoc
    */
    public function expr(): ExpressionInterface
    {
        return $this->factory->createExpr();
    }






    /**
     * @inheritDoc
    */
    public function select(string $selects = null): SelectBuilderInterface
    {
        return $this->factory->createSelect()
                             ->select($selects ?: "*");
    }





    /**
     * @inheritDoc
    */
    public function insert(string $table): InsertBuilderInterface
    {
        return $this->factory->createInsert()
                             ->insert($table);
    }





    /**
     * @inheritDoc
    */
    public function update(string $table): UpdateBuilderInterface
    {
        return $this->factory->createUpdate()
                             ->update($table);
    }





    /**
     * @inheritDoc
    */
    public function delete(string $table): DeleteBuilderInterface
    {
        return $this->factory->createDelete()
                             ->delete($table);
    }
}
