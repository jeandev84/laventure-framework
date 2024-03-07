<?php
declare(strict_types=1);

namespace Laventure\Component\Database\Connection\Drivers\Oracle;

use Laventure\Component\Database\Connection\Drivers\Oracle\Table\OracleTable;
use Laventure\Component\Database\Connection\Extensions\PDO\PdoConnection;
use Laventure\Component\Database\Connection\Name\ConnectionName;
use Laventure\Component\Database\DatabaseInterface;
use Laventure\Component\Database\Query\Builder\SQL\SQLQueryBuilderInterface;
use Laventure\Component\Database\Schema\Table\TableInterface;

/**
 * OracleConnection
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\PdoConnection\Drivers\Oracle
*/
class OracleConnection extends PdoConnection
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
    public function createQueryBuilder(): SQLQueryBuilderInterface
    {
        return new OracleQueryBuilder($this->createSQLBuilderFactory());
    }





    /**
     * @inheritDoc
    */
    public function createTable(string $name, string $schemaName = ''): TableInterface
    {
        return new OracleTable($this, $name, $schemaName);
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
}
