<?php

declare(strict_types=1);

namespace Laventure\Component\Database\Drivers\Mysql\Schema\Table;

use Laventure\Component\Database\Connection\ConnectionInterface;
use Laventure\Component\Database\Schema\Table\Factory\TableFactoryInterface;
use Laventure\Component\Database\Schema\Table\TableInterface;

/**
 * MysqlTableFactory
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\Schema\Table\Drivers\Mysql
*/
class MysqlTableFactory implements TableFactoryInterface
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
        return new MysqlTable($this->connection, $name);
    }
}
