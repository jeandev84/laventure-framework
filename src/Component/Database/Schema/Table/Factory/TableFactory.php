<?php

declare(strict_types=1);

namespace Laventure\Component\Database\Schema\Table\Factory;

use Laventure\Component\Database\Connection\ConnectionInterface;
use Laventure\Component\Database\Connection\Types\ConnectionType;
use Laventure\Component\Database\Schema\Table\Drivers\Mysql\MysqlTable;
use Laventure\Component\Database\Schema\Table\TableInterface;

/**
 * TableFactory
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\Schema\Table\Factory
*/
class TableFactory implements TableFactoryInterface
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
    public function createTable(string $name): TableInterface
    {
        return match ($this->connection->getName()) {
            ConnectionType::Mysql => new MysqlTable($this->connection, $name)
        };
    }
}
