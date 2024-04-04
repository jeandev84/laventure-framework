<?php

declare(strict_types=1);

namespace Laventure\Component\Database\Drivers\Mysql\Connection;

use Laventure\Component\Database\Collection\Contract\DatabaseCollectionInterface;
use Laventure\Component\Database\Connection\Extensions\PDO\PdoConnection;
use Laventure\Component\Database\Connection\Transaction\Contract\TransactionInterface;
use Laventure\Component\Database\Drivers\DriverName;
use Laventure\Component\Database\Drivers\Mysql\Collection\MysqlDatabaseCollection;
use Laventure\Component\Database\Drivers\Mysql\Connection\Transaction\MysqlTransaction;
use Laventure\Component\Database\Drivers\Mysql\Factory\MysqlDatabaseFactory;
use Laventure\Component\Database\Drivers\Mysql\Query\Builder\MysqlQueryBuilder;
use Laventure\Component\Database\Drivers\Mysql\Schema\Table\MysqlTable;
use Laventure\Component\Database\Factory\DatabaseFactoryInterface;
use Laventure\Component\Database\Query\Builder\QueryBuilderInterface;
use Laventure\Component\Database\Schema\Table\TableInterface;

/**
 * MysqlConnection
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\PdoConnection\Drivers\Mysql
*/
class MysqlConnection extends PdoConnection
{
    /**
     * @inheritdoc
    */
    public function getName(): string
    {
        return DriverName::Mysql;
    }






    /**
     * @inheritDoc
    */
    public function table(string $name): TableInterface
    {
        return new MysqlTable($this, $name);
    }







    /**
     * @inheritDoc
    */
    public function transaction(): TransactionInterface
    {
        return new MysqlTransaction($this);
    }






    /**
     * @inheritDoc
    */
    public function getDatabaseNames(): array
    {
        return $this->statement("SHOW DATABASES;")
                    ->fetch()
                    ->columns();
    }





    /**
     * @inheritDoc
    */
    public function getDatabaseFactory(): DatabaseFactoryInterface
    {
        return new MysqlDatabaseFactory($this);
    }






    /**
     * @inheritDoc
    */
    public function getDatabaseCollection(): DatabaseCollectionInterface
    {
        return new MysqlDatabaseCollection($this->getDatabases());
    }




    /**
     * @inheritDoc
    */
    public function createQueryBuilder(): QueryBuilderInterface
    {
        return new MysqlQueryBuilder($this);
    }
}
