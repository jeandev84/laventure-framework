<?php
declare(strict_types=1);

namespace Laventure\Component\Database\Connection\Drivers\Sqlite;

use Laventure\Component\Database\Connection\ConnectionInterface;
use Laventure\Component\Database\Connection\Extensions\PDO\PdoConnectionTrait;
use Laventure\Component\Database\Connection\Name\ConnectionName;
use Laventure\Component\Database\Connection\Query\Builder\SQLQueryBuilderInterface;
use Laventure\Component\Database\DatabaseInterface;
use Laventure\Component\Database\Schema\Table\TableInterface;

/**
 * SqliteConnection
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\Connection\Drivers\Sqlite
*/
class SqliteConnection implements ConnectionInterface
{

    use PdoConnectionTrait;


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
    public function createQueryBuilder(): SQLQueryBuilderInterface
    {
        return new SqliteQueryBuilder($this);
    }




    /**
     * @inheritDoc
    */
    public function getDatabase(): DatabaseInterface
    {
        return new SqliteDatabase($this);
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

    /**
     * @inheritDoc
     */
    public function createTable(string $name, string $schemaName = ''): TableInterface
    {
        // TODO: Implement createTable() method.
    }
}
