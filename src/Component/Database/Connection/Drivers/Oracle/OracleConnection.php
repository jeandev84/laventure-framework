<?php
declare(strict_types=1);

namespace Laventure\Component\Database\Connection\Drivers\Oracle;

use Laventure\Component\Database\Connection\ConnectionInterface;
use Laventure\Component\Database\Connection\ConnectionName;
use Laventure\Component\Database\Connection\Extensions\PDO\Drivers\Oracle\OracleDatabase;
use Laventure\Component\Database\Connection\Extensions\PDO\PdoConnection;
use Laventure\Component\Database\Connection\Query\Builder\SQLQueryBuilderInterface;
use Laventure\Component\Database\DatabaseInterface;

/**
 * OracleConnection
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\Connection\Extensions\PDO\Drivers\Oracle
*/
class OracleConnection extends PdoConnection implements ConnectionInterface
{
    /**
     * @inheritDoc
    */
    public function getName(): string
    {
        return ConnectionName::Oracle;
    }



    /**
     * @inheritDoc
    */
    public function getDatabase(): DatabaseInterface
    {
        return new OracleDatabase($this);
    }





    /**
     * @inheritDoc
    */
    public function activateTransaction(): void
    {

    }




    /**
     * @inheritDoc
    */
    public function disableTransaction(): void
    {

    }




    /**
     * @inheritDoc
    */
    public function createQueryBuilder(): SQLQueryBuilderInterface
    {
        return new OracleQueryBuilder($this);
    }
}
