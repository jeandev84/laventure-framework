<?php
declare(strict_types=1);

namespace Laventure\Component\Database\Drivers\Mysql\Factory;

use Laventure\Component\Database\DatabaseInterface;
use Laventure\Component\Database\Drivers\Mysql\Connection\MysqlConnection;
use Laventure\Component\Database\Drivers\Mysql\MysqlDatabase;
use Laventure\Component\Database\Factory\DatabaseFactoryInterface;

/**
 * MysqlDatabaseFactory
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\Drivers\Mysql\Factory
*/
class MysqlDatabaseFactory implements DatabaseFactoryInterface
{

    /**
     * @param MysqlConnection $connection
    */
    public function __construct(
        protected MysqlConnection $connection
    )
    {
    }




    /**
     * @inheritDoc
    */
    public function createDatabase(string $name): DatabaseInterface
    {
        return new MysqlDatabase($this->connection, $name);
    }





    /**
     * @inheritDoc
    */
    public function createDatabases(array $names): array
    {
        return array_map(function (string $name) {
            return $this->createDatabase($name);
        }, $names);
    }
}