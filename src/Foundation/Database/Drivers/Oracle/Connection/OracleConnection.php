<?php
declare(strict_types=1);

namespace Laventure\Foundation\Database\Drivers\Oracle\Connection;

use Laventure\Component\Database\Collection\Contract\DatabaseCollectionInterface;
use Laventure\Component\Database\Connection\Extensions\PDO\PdoConnection;
use Laventure\Component\Database\Factory\DatabaseFactoryInterface;
use Laventure\Component\Database\Query\Builder\SQL\SQLQueryBuilderInterface;
use Laventure\Component\Database\Schema\Table\TableInterface;
use Laventure\Foundation\Database\Drivers\DriverName;
use Laventure\Foundation\Database\Drivers\Oracle\Collection\OracleDatabaseCollection;
use Laventure\Foundation\Database\Drivers\Oracle\Factory\OracleDatabaseFactory;
use Laventure\Foundation\Database\Drivers\Oracle\OracleQueryBuilder;
use Laventure\Foundation\Database\Drivers\Oracle\Schema\Table\OracleTable;

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
        return DriverName::Oracle;
    }





    /**
     * @inheritDoc
    */
    public function createQueryBuilder(): SQLQueryBuilderInterface
    {
        return new OracleQueryBuilder($this->createPdoQueryBuilder());
    }





    /**
     * @inheritDoc
    */
    public function table(string $name, string $schemaName = ''): TableInterface
    {
        return new OracleTable($this, $name);
    }





    /**
     * @inheritDoc
    */
    public function getDatabaseFactory(): DatabaseFactoryInterface
    {
        return new OracleDatabaseFactory($this);
    }






    /**
     * @inheritDoc
    */
    public function getDatabaseCollection(): DatabaseCollectionInterface
    {
        return new OracleDatabaseCollection($this->getDatabases());
    }





    /**
     * @inheritDoc
    */
    public function getDatabaseNames(): array
    {
         return [];
    }
}
