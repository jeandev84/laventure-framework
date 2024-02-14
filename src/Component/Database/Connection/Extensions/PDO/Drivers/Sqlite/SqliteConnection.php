<?php

declare(strict_types=1);

namespace Laventure\Component\Database\Connection\Extensions\PDO\Drivers\Sqlite;

use Laventure\Component\Database\Connection\ConnectionType;
use Laventure\Component\Database\Connection\Drivers\Sqlite\SqliteDatabase;
use Laventure\Component\Database\Connection\Extensions\PDO\PdoConnection;
use Laventure\Component\Database\DatabaseInterface;

/**
 * SqliteConnection
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\Connection\Extensions\PDO\Drivers\Sqlite
*/
class SqliteConnection extends PdoConnection
{
    /**
     * @inheritDoc
    */
    public function getName(): string
    {
        return ConnectionType::Sqlite;
    }



    /**
     * @inheritDoc
    */
    public function getDatabase(): DatabaseInterface
    {
        return new SqliteDatabase($this, $this->getDatabaseName());
    }
}
