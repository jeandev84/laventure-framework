<?php

declare(strict_types=1);

namespace Laventure\Component\Database\Drivers\Pgsql\Connection;

use Laventure\Component\Database\Collection\Contract\DatabaseCollectionInterface;
use Laventure\Component\Database\Connection\Extensions\PDO\PdoConnection;
use Laventure\Component\Database\Drivers\DriverName;
use Laventure\Component\Database\Drivers\Pgsql\Collection\PgsqlDatabaseCollection;
use Laventure\Component\Database\Drivers\Pgsql\Factory\PgsqlDatabaseFactory;
use Laventure\Component\Database\Drivers\Pgsql\Query\Builder\PgsqlQueryBuilder;
use Laventure\Component\Database\Drivers\Pgsql\Schema\Table\PgsqlTable;
use Laventure\Component\Database\Factory\DatabaseFactoryInterface;
use Laventure\Component\Database\Query\Builder\QueryBuilderInterface;
use Laventure\Component\Database\Schema\Table\TableInterface;

/**
 * PgsqlConnection
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\PdoConnection\Drivers\Pgsql
*/
class PgsqlConnection extends PdoConnection
{
    /**
     * @inheritDoc
    */
    public function getName(): string
    {
        return DriverName::Pgsql;
    }




    /**
     * @inheritDoc
    */
    public function createQueryBuilder(): QueryBuilderInterface
    {
        return new PgsqlQueryBuilder($this);
    }




    /**
     * @inheritDoc
    */
    public function table(string $name): TableInterface
    {
        return new PgsqlTable($this, $name);
    }





    /**
     * @inheritDoc
    */
    public function getDatabaseFactory(): DatabaseFactoryInterface
    {
        return new PgsqlDatabaseFactory($this);
    }





    /**
     * @inheritDoc
    */
    public function getDatabaseNames(): array
    {
        return [];
    }




    /**
     * @inheritDoc
    */
    public function getDatabaseCollection(): DatabaseCollectionInterface
    {
        return new PgsqlDatabaseCollection($this->getDatabases());
    }
}
