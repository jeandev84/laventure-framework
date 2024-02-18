<?php

declare(strict_types=1);

namespace Laventure\Component\Database\Schema\Table\Factory;

use Laventure\Component\Database\Connection\ConnectionInterface;
use Laventure\Component\Database\Connection\ConnectionType;
use Laventure\Component\Database\Schema\Column\Types\Mysql\MysqlColumnFactory;
use Laventure\Component\Database\Schema\Table\Types\Mysql\MysqlTable;
use Laventure\Component\Database\Schema\Table\Types\Mysql\MysqlTableFactory;
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
    public function createTable(
        string $name,
        string $schemaName = ''
    ): TableInterface
    {
        $factory = match ($this->connection->getName()) {
            ConnectionType::Mysql => new MysqlTableFactory($this->connection)
        };

        return $factory->createTable($name, $schemaName);
    }
}
