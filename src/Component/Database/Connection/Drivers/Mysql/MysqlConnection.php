<?php
declare(strict_types=1);

namespace Laventure\Component\Database\Connection\Drivers\Mysql;

use Laventure\Component\Database\Connection\Drivers\Mysql\Table\MysqlTable;
use Laventure\Component\Database\Connection\Extensions\PDO\Connection;
use Laventure\Component\Database\Connection\Name\ConnectionName;
use Laventure\Component\Database\DatabaseInterface;
use Laventure\Component\Database\Query\Builder\SQL\SQLQueryBuilderInterface;
use Laventure\Component\Database\Schema\Table\TableInterface;

/**
 * MysqlConnection
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\Connection\Drivers\Mysql
*/
class MysqlConnection extends Connection
{

    /**
     * @inheritdoc
    */
    public function getName(): string
    {
        return ConnectionName::Mysql;
    }




    /**
     * @inheritDoc
    */
    public function createQueryBuilder(): SQLQueryBuilderInterface
    {
        return new MysqlQueryBuilder($this->createSQLBuilderFactory());
    }





    /**
     * @inheritDoc
    */
    public function createTable(string $name, string $schemaName = ''): TableInterface
    {
        return new MysqlTable($this, $name, $schemaName);
    }





    /**
     * @return DatabaseInterface
    */
    public function getDatabase(): DatabaseInterface
    {
        return new MysqlDatabase($this);
    }




    /**
     * @return void
    */
    public function activateTransaction(): void
    {
        $this->executeQuery('SET autocommit = 1');
    }



    /**
     * @return void
    */
    public function disableTransaction(): void
    {
        $this->executeQuery('SET autocommit = 0');
    }
}
