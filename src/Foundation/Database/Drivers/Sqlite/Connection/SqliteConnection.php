<?php

declare(strict_types=1);

namespace Laventure\Foundation\Database\Drivers\Sqlite\Connection;

use Laventure\Component\Database\Collection\Contract\DatabaseCollectionInterface;
use Laventure\Component\Database\Connection\Extensions\PDO\Dsn\Builder\Factory\PdoDsnBuilderFactoryInterface;
use Laventure\Component\Database\Connection\Extensions\PDO\PdoConnection;
use Laventure\Component\Database\DatabaseInterface;
use Laventure\Component\Database\Factory\DatabaseFactoryInterface;
use Laventure\Component\Database\Query\Builder\SQL\SQLQueryBuilderInterface;
use Laventure\Component\Database\Schema\Table\TableInterface;
use Laventure\Foundation\Database\Drivers\DriverName;
use Laventure\Foundation\Database\Drivers\Sqlite\Collection\SqliteDatabaseCollection;
use Laventure\Foundation\Database\Drivers\Sqlite\Connection\Dsn\Factory\SqliteDsnBuilderFactory;
use Laventure\Foundation\Database\Drivers\Sqlite\Factory\SqliteDatabaseFactory;
use Laventure\Foundation\Database\Drivers\Sqlite\Query\Builder\SqliteQueryBuilder;
use Laventure\Foundation\Database\Drivers\Sqlite\Schema\Table\SqliteTable;
use Laventure\Foundation\Database\Drivers\Sqlite\SqliteDatabase;

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
    public function createQueryBuilder(): SQLQueryBuilderInterface
    {
        return new SqliteQueryBuilder($this->createPdoQueryBuilder());
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
