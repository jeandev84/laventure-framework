<?php

declare(strict_types=1);

namespace Laventure\Component\Database\Connection;

use Laventure\Component\Database\Connection\Extensions\PDO\Drivers\Mysql\MysqlConnection;
use Laventure\Component\Database\Connection\Extensions\PDO\Drivers\Oracle\OracleConnection;
use Laventure\Component\Database\Connection\Extensions\PDO\Drivers\Pgsql\PgsqlConnection;
use Laventure\Component\Database\Connection\Extensions\PDO\Drivers\Sqlite\SqliteConnection;
use Laventure\Component\Database\Connection\Extensions\PDO\Factory\PdoConnectionFactory;

/**
 * ConnectionStack
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\Connection
*/
class ConnectionStack
{
    /**
     * @return array
    */
    public static function getDefaults(): array
    {
        $pdoFactory = new PdoConnectionFactory();

        return [
            new MysqlConnection($pdoFactory),
            new PgsqlConnection($pdoFactory),
            new SqliteConnection($pdoFactory),
            new OracleConnection($pdoFactory)
        ];
    }
}
