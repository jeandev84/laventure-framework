<?php

declare(strict_types=1);

namespace Laventure\Component\Database\Drivers\Oracle\Connection;

use Laventure\Component\Database\Collection\Contract\DatabaseCollectionInterface;
use Laventure\Component\Database\Connection\Extensions\PDO\PdoConnection;
use Laventure\Component\Database\Drivers\DriverName;
use Laventure\Component\Database\Drivers\Oracle\Collection\OracleDatabaseCollection;
use Laventure\Component\Database\Drivers\Oracle\Factory\OracleDatabaseFactory;
use Laventure\Component\Database\Drivers\Oracle\Query\Builder\OracleQueryBuilder;
use Laventure\Component\Database\Drivers\Oracle\Schema\Table\OracleTable;
use Laventure\Component\Database\Drivers\Pgsql\Query\Builder\PgsqlQueryBuilder;
use Laventure\Component\Database\Factory\DatabaseFactoryInterface;
use Laventure\Component\Database\Query\Builder\QueryBuilderInterface;
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
        return DriverName::Oracle;
    }



    /**
     * @inheritDoc
    */
    public function createQueryBuilder(): QueryBuilderInterface
    {
        return new OracleQueryBuilder($this);
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
