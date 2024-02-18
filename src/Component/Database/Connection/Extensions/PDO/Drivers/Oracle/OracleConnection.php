<?php

declare(strict_types=1);

namespace Laventure\Component\Database\Connection\Extensions\PDO\Drivers\Oracle;

use Laventure\Component\Database\Connection\ConnectionType;
use Laventure\Component\Database\Connection\Drivers\Oracle\OracleDatabase;
use Laventure\Component\Database\Connection\Extensions\PDO\PdoConnection;
use Laventure\Component\Database\DatabaseInterface;

/**
 * OracleConnection
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\Connection\Extensions\PDO\Types\Oracle
*/
class OracleConnection extends PdoConnection
{
    /**
     * @inheritDoc
    */
    public function getName(): string
    {
        return ConnectionType::Oracle;
    }



    /**
     * @inheritDoc
    */
    public function getDatabase(): DatabaseInterface
    {
        return new OracleDatabase($this, $this->getDatabaseName());
    }
}
