<?php

declare(strict_types=1);

namespace Laventure\Component\Database\Schema\Table\Factory;

use Laventure\Component\Database\Connection\ConnectionInterface;
use Laventure\Component\Database\Connection\ConnectionName;
use Laventure\Component\Database\Schema\Table\TableInterface;
use Laventure\Component\Database\Schema\Table\Types\Mysql\MysqlTableFactory;

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
            ConnectionName::Mysql => new MysqlTableFactory($this->connection)
        };

        return $factory->createTable($name, $schemaName);
    }
}
