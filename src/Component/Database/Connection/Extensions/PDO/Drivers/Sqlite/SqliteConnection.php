<?php

declare(strict_types=1);

namespace Laventure\Component\Database\Connection\Extensions\PDO\Drivers\Sqlite;

use Laventure\Component\Database\Connection\ConnectionName;
use Laventure\Component\Database\Connection\Extensions\PDO\PdoConnection;
use Laventure\Component\Database\Drivers\DatabaseInterface;
use Laventure\Component\Database\Drivers\Sqlite\SqliteDatabase;

/**
 * SqliteConnection
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\Connection\Extensions\PDO\Types\Sqlite
*/
class SqliteConnection extends PdoConnection
{
    /**
     * @inheritDoc
    */
    public function getName(): string
    {
        return ConnectionName::Sqlite;
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
    public function activateTransaction(): void
    {
        // TODO: Implement activateTransaction() method.
    }

    /**
     * @inheritDoc
     */
    public function disableTransaction(): void
    {
        // TODO: Implement disableTransaction() method.
    }
}
