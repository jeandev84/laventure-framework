<?php

declare(strict_types=1);

namespace Laventure\Component\Database\Drivers\Sqlite\Schema\Table;

use Laventure\Component\Database\Connection\ConnectionInterface;
use Laventure\Component\Database\Schema\Table\Factory\TableFactoryInterface;
use Laventure\Component\Database\Schema\Table\TableInterface;

/**
 * SqliteTableFactory
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\Schema\Table\Drivers\Sqlite
*/
class SqliteTableFactory implements TableFactoryInterface
{
    /**
     * @param ConnectionInterface $connection
    */
    public function __construct(
        protected ConnectionInterface $connection
    ) {
    }



    /**
     * @inheritDoc
    */
    public function createTable(string $name, string $schemaName = ''): TableInterface
    {
        return new SqliteTable($this->connection, $name, $schemaName);
    }
}
