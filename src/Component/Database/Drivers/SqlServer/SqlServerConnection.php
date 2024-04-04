<?php

declare(strict_types=1);

namespace Laventure\Component\Database\Drivers\SqlServer;

use Laventure\Component\Database\Configuration\Contract\ConfigurationInterface;
use Laventure\Component\Database\Connection\ConnectionInterface;
use Laventure\Component\Database\DatabaseInterface;
use Laventure\Component\Database\Drivers\DriverName;
use Laventure\Component\Database\Query\Builder\SQL\SQLQueryBuilderInterface;
use Laventure\Component\Database\Query\QueryInterface;
use Laventure\Component\Database\Schema\Table\TableInterface;

/**
 * SqlServerConnection
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\PdoConnection\Drivers\SqlServer
*/
class SqlServerConnection implements ConnectionInterface
{
    /**
     * @inheritDoc
    */
    public function getName(): string
    {
        return DriverName::SqlServer;
    }




    /**
     * @inheritDoc
    */
    public function connect(ConfigurationInterface $config): void
    {

    }




    /**
     * @inheritDoc
    */
    public function connected(): bool
    {

    }




    /**
     * @inheritDoc
    */
    public function disconnect(): void
    {

    }



    /**
     * @inheritDoc
    */
    public function purge(): void
    {

    }




    /**
     * @inheritDoc
    */
    public function disconnected(): bool
    {

    }




    /**
     * @inheritDoc
    */
    public function getConnection(): mixed
    {

    }




    /**
     * @inheritDoc
    */
    public function createQuery(): QueryInterface
    {

    }




    /**
     * @inheritDoc
    */
    public function createQueryBuilder(): SQLQueryBuilderInterface
    {

    }




    /**
     * @inheritDoc
    */
    public function table(string $name, string $schemaName = ''): TableInterface
    {

    }




    /**
     * @inheritDoc
    */
    public function statement(string $sql): QueryInterface
    {

    }




    /**
     * @inheritDoc
    */
    public function exec(string $sql): mixed
    {

    }





    /**
     * @inheritDoc
    */
    public function getConfiguration(): ConfigurationInterface
    {

    }





    /**
     * @inheritDoc
    */
    public function getDatabase(): DatabaseInterface
    {

    }





    /**
     * @inheritDoc
    */
    public function enableTransaction(): void
    {

    }



    /**
     * @inheritDoc
    */
    public function begin(): bool
    {

    }



    /**
     * @inheritDoc
    */
    public function hasActive(): bool
    {

    }



    /**
     * @inheritDoc
    */
    public function commit(): bool
    {

    }



    /**
     * @inheritDoc
    */
    public function rollback(): bool
    {

    }




    /**
     * @inheritDoc
    */
    public function transaction(callable $func): mixed
    {

    }




    /**
     * @inheritDoc
    */
    public function transactionIf(callable $func, bool $condition = false): mixed
    {

    }




    /**
     * @inheritDoc
    */
    public function disableTransaction(): void
    {

    }
}
