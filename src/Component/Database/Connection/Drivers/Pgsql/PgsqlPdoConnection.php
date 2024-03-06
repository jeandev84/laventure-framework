<?php
declare(strict_types=1);

namespace Laventure\Component\Database\Connection\Drivers\Pgsql;

use Laventure\Component\Database\Connection\Extensions\PDO\PdoConnection;
use Laventure\Component\Database\Connection\Name\ConnectionName;
use Laventure\Component\Database\DatabaseInterface;
use Laventure\Component\Database\Query\Builder\SQL\SQLQueryBuilderInterface;
use Laventure\Component\Database\Schema\Table\TableInterface;

/**
 * PgsqlPdoConnection
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\PdoConnection\Drivers\Pgsql
*/
class PgsqlPdoConnection extends PdoConnection
{

    /**
     * @inheritDoc
    */
    public function getName(): string
    {
        return ConnectionName::Pgsql;
    }




    /**
     * @inheritDoc
    */
    public function createQueryBuilder(): SQLQueryBuilderInterface
    {
        return new PgsqlQueryBuilder($this);
    }




    /**
     * @inheritDoc
    */
    public function getDatabase(): DatabaseInterface
    {
        return new PgsqlDatabase($this);
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
    public function createTable(string $name, string $schemaName = ''): TableInterface
    {
        // TODO: Implement createTable() method.
    }
}
