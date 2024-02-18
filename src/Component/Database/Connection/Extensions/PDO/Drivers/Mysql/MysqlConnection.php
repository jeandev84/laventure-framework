<?php

declare(strict_types=1);

namespace Laventure\Component\Database\Connection\Extensions\PDO\Drivers\Mysql;

use Laventure\Component\Database\Connection\ConnectionName;
use Laventure\Component\Database\Connection\Drivers\Mysql\MysqlConnectionTrait;
use Laventure\Component\Database\Connection\Extensions\PDO\PdoConnection;
use Laventure\Component\Database\DatabaseInterface;
use Laventure\Component\Database\Drivers\Mysql\MysqlDatabase;

/**
 * MysqlConnection
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\Connection\Extensions\PDO\Types\Mysql
*/
class MysqlConnection extends PdoConnection
{
    /**
     * @return string
    */
    public function getName(): string
    {
        return ConnectionName::Mysql;
    }



    /**
     * @return DatabaseInterface
    */
    public function getDatabase(): DatabaseInterface
    {
        return new MysqlDatabase($this, $this->getDatabaseName());
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
