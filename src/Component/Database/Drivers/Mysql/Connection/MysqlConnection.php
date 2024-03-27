<?php

declare(strict_types=1);

namespace Laventure\Component\Database\Drivers\Mysql\Connection;

use Laventure\Component\Database\Collection\Contract\DatabaseCollectionInterface;
use Laventure\Component\Database\Connection\Extensions\PDO\PdoConnection;
use Laventure\Component\Database\Connection\Transaction\Contract\TransactionInterface;
use Laventure\Component\Database\DatabaseInterface;
use Laventure\Component\Database\Drivers\DriverName;
use Laventure\Component\Database\Drivers\Mysql\Collection\MysqlDatabaseCollection;
use Laventure\Component\Database\Drivers\Mysql\Connection\Transaction\MysqlTransaction;
use Laventure\Component\Database\Drivers\Mysql\Factory\MysqlDatabaseFactory;
use Laventure\Component\Database\Drivers\Mysql\MysqlDatabase;
use Laventure\Component\Database\Drivers\Mysql\Query\Builder\MysqlQueryBuilder;
use Laventure\Component\Database\Drivers\Mysql\Schema\Table\MysqlTable;
use Laventure\Component\Database\Factory\DatabaseFactoryInterface;
use Laventure\Component\Database\Query\Builder\SQL\SQLQueryBuilderInterface;
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
    public function createQueryBuilder(): SQLQueryBuilderInterface
    {
        return new MysqlQueryBuilder($this->createPdoQueryBuilder());
    }





    /**
     * @inheritDoc
    */
    public function table(string $name, string $schemaName = ''): TableInterface
    {
        return new MysqlTable($this, $name);
    }





    /**
     * @return DatabaseInterface
    */
    public function getDatabase(): DatabaseInterface
    {
        return $this->getDatabaseFactory()
                    ->createDatabase($this->getDatabaseName());
    }


    
    
    
    /**
     * @inheritDoc
    */
    public function createTransaction(): TransactionInterface
    {
        return new MysqlTransaction($this);
    }
    
    
    
    


    /**
     * @inheritDoc
    */
    public function getDatabaseNames(): array
    {
        return $this->connection
                    ->statement("SHOW DATABASES;")
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
    public function getDatabases(): array
    {
        return $this->getDatabaseFactory()
                    ->createDatabases($this->getDatabaseNames());
    }
}
