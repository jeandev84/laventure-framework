<?php
declare(strict_types=1);

namespace Laventure\Component\Database\Manager\Factory;

use Laventure\Component\Database\Connection\Extensions\Mysqli\MysqliConnection;
use Laventure\Component\Database\Connection\Extensions\PDO\Drivers\Mysql\MysqlConnection;
use Laventure\Component\Database\Connection\Extensions\PDO\Drivers\Oracle\OracleConnection;
use Laventure\Component\Database\Connection\Extensions\PDO\Drivers\Pgsql\PgsqlConnection;
use Laventure\Component\Database\Connection\Extensions\PDO\Drivers\Sqlite\SqliteConnection;
use Laventure\Component\Database\Connection\Extensions\PDO\Factory\PdoConnectionFactory;
use Laventure\Component\Database\Manager\DatabaseManager;
use Laventure\Component\Database\Manager\DatabaseManagerInterface;

/**
 * DatabaseManagerFactory
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\Manager
*/
class DatabaseManagerFactory implements DatabaseManagerFactoryInterface
{
    /**
     * @inheritDoc
    */
    public function createDatabaseManager(): DatabaseManagerInterface
    {
        return new DatabaseManager([
            new MysqlConnection(),
            new PgsqlConnection(),
            new SqliteConnection(),
            new OracleConnection()
        ]);
    }
}
