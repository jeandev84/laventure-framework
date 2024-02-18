<?php

declare(strict_types=1);

namespace Laventure\Component\Database\Connection\Extensions\PDO\Drivers\Mysql;

use Laventure\Component\Database\Connection\ConnectionType;
use Laventure\Component\Database\Connection\Drivers\Mysql\MysqlDatabase;
use Laventure\Component\Database\Connection\Extensions\PDO\PdoConnection;
use Laventure\Component\Database\DatabaseInterface;

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
     * @inheritDoc
    */
    public function getName(): string
    {
        return ConnectionType::Mysql;
    }




    /**
     * @inheritDoc
    */
    public function getDatabase(): DatabaseInterface
    {
        return new MysqlDatabase($this, $this->getDatabaseName());
    }
}
