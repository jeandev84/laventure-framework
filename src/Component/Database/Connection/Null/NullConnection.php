<?php

declare(strict_types=1);

namespace Laventure\Component\Database\Connection\Null;

use Laventure\Component\Database\Configuration\Contract\ConfigurationInterface;
use Laventure\Component\Database\Configuration\Null\NullConfiguration;
use Laventure\Component\Database\Connection\ConnectionInterface;
use Laventure\Component\Database\DatabaseInterface;
use Laventure\Component\Database\Null\NullDatabase;
use Laventure\Component\Database\Query\Builder\SQL\Null\NullSQLQueryBuilder;
use Laventure\Component\Database\Query\Builder\SQL\SQLQueryBuilderInterface;
use Laventure\Component\Database\Query\Null\NullQuery;
use Laventure\Component\Database\Query\QueryInterface;

/**
 * NullConnection
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\PdoConnection
*/
class NullConnection implements ConnectionInterface
{
    /**
     * @inheritDoc
    */
    public function getName(): string
    {
        return '';
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
        return false;
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
        return false;
    }




    /**
     * @inheritDoc
    */
    public function getConnection(): mixed
    {
        return null;
    }





    /**
     * @inheritDoc
    */
    public function createQuery(): QueryInterface
    {
        return new NullQuery();
    }




    /**
     * @inheritDoc
    */
    public function createQueryBuilder(): SQLQueryBuilderInterface
    {
        return new NullSQLQueryBuilder();
    }




    /**
     * @inheritDoc
    */
    public function statement(string $sql): QueryInterface
    {
        return $this->createQuery()->prepare($sql);
    }




    /**
     * @inheritDoc
    */
    public function executeQuery(string $sql): mixed
    {
        return false;
    }




    /**
     * @inheritDoc
    */
    public function getDatabaseName(): string
    {
        return '';
    }



    /**
     * @inheritDoc
    */
    public function getConfiguration(): ConfigurationInterface
    {
        return new NullConfiguration();
    }




    /**
     * @inheritDoc
    */
    public function getDatabase(): DatabaseInterface
    {
        return new NullDatabase();
    }




    /**
     * @inheritDoc
    */
    public function beginTransaction(): bool
    {
        return false;
    }




    /**
     * @inheritDoc
    */
    public function hasActiveTransaction(): bool
    {
        return false;
    }




    /**
     * @inheritDoc
    */
    public function commit(): bool
    {
        return false;
    }




    /**
     * @inheritDoc
    */
    public function rollback(): bool
    {
        return false;
    }





    /**
     * @inheritDoc
    */
    public function transaction(callable $func): mixed
    {
        return null;
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
    public function transactionIf(callable $func, bool $condition = false): mixed
    {
        return null;
    }




    /**
     * @inheritDoc
    */
    public function disableTransaction(): void
    {

    }
}
