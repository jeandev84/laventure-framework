<?php

declare(strict_types=1);

namespace Laventure\Component\Database\Drivers\Sqlite\Connection;

use Laventure\Component\Database\Collection\Contract\DatabaseCollectionInterface;
use Laventure\Component\Database\Connection\Extensions\PDO\Dsn\Builder\Factory\PdoDsnBuilderFactoryInterface;
use Laventure\Component\Database\Connection\Extensions\PDO\PdoConnection;
use Laventure\Component\Database\DatabaseInterface;
use Laventure\Component\Database\Drivers\DriverName;
use Laventure\Component\Database\Drivers\Sqlite\Collection\SqliteDatabaseCollection;
use Laventure\Component\Database\Drivers\Sqlite\Connection\Dsn\Factory\SqliteDsnBuilderFactory;
use Laventure\Component\Database\Drivers\Sqlite\Factory\SqliteDatabaseFactory;
use Laventure\Component\Database\Drivers\Sqlite\Query\Builder\SqliteQueryBuilder;
use Laventure\Component\Database\Drivers\Sqlite\Schema\Table\SqliteTable;
use Laventure\Component\Database\Drivers\Sqlite\SqliteDatabase;
use Laventure\Component\Database\Factory\DatabaseFactoryInterface;
use Laventure\Component\Database\Query\Builder\QueryBuilderInterface;
use Laventure\Component\Database\Query\Builder\SQL\SQLQueryBuilderInterface;
use Laventure\Component\Database\Schema\Table\TableInterface;

/**
 * SqliteConnection
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\PdoConnection\Drivers\Sqlite
*/
class SqliteConnection extends PdoConnection
{
    /**
     * @inheritDoc
    */
    public function getName(): string
    {
        return DriverName::Sqlite;
    }






    /**
     * @inheritDoc
    */
    public function createQueryBuilder(): QueryBuilderInterface
    {
        return new SqliteQueryBuilder($this);
    }





    /**
     * @inheritDoc
    */
    public function getDatabase(): DatabaseInterface
    {
        return new SqliteDatabase($this, $this->getDatabaseName());
    }





    /**
     * @inheritDoc
    */
    public function table(string $name): TableInterface
    {
        return new SqliteTable($this, $name);
    }






    /**
     * @inheritDoc
    */
    public function getPdoDsnBuilderFactory(): PdoDsnBuilderFactoryInterface
    {
        return new SqliteDsnBuilderFactory();
    }





    /**
     * @inheritDoc
    */
    public function getDatabaseFactory(): DatabaseFactoryInterface
    {
        return new SqliteDatabaseFactory($this);
    }




    /**
     * @inheritDoc
    */
    public function getDatabaseCollection(): DatabaseCollectionInterface
    {
        return new SqliteDatabaseCollection($this->getDatabases());
    }




    /**
     * @inheritDoc
    */
    public function getDatabaseNames(): array
    {
        return [];
    }
}
