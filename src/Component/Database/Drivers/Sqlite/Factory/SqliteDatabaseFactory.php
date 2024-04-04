<?php

declare(strict_types=1);

namespace Laventure\Component\Database\Drivers\Sqlite\Factory;

use Laventure\Component\Database\DatabaseInterface;
use Laventure\Component\Database\Drivers\Sqlite\Connection\SqliteConnection;
use Laventure\Component\Database\Drivers\Sqlite\SqliteDatabase;
use Laventure\Component\Database\Factory\DatabaseFactory;

/**
 * SqliteDatabaseFactory
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\Drivers\Sqlite\Factory
*/
class SqliteDatabaseFactory extends DatabaseFactory
{
    /**
     * @param SqliteConnection $connection
    */
    public function __construct(
        protected SqliteConnection $connection
    ) {
    }




    /**
     * @inheritDoc
    */
    public function createDatabase(string $name): DatabaseInterface
    {
        return new SqliteDatabase($this->connection, $name);
    }
}
