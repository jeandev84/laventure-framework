<?php

declare(strict_types=1);

namespace Laventure\Component\Database\Connection\Null;

use Laventure\Component\Database\Collection\Contract\DatabaseCollectionInterface;
use Laventure\Component\Database\Configuration\Contract\ConfigurationInterface;
use Laventure\Component\Database\Configuration\Null\NullConfiguration;
use Laventure\Component\Database\Connection\ConnectionInterface;
use Laventure\Component\Database\Connection\Transaction\Contract\TransactionInterface;
use Laventure\Component\Database\DatabaseInterface;
use Laventure\Component\Database\Factory\DatabaseFactoryInterface;
use Laventure\Component\Database\Null\NullDatabase;
use Laventure\Component\Database\Query\Builder\SQL\Null\NullSQLQueryBuilder;
use Laventure\Component\Database\Query\Builder\SQL\SQLQueryBuilderInterface;
use Laventure\Component\Database\Query\Logger\QueryLoggerInterface;
use Laventure\Component\Database\Query\Null\NullQuery;
use Laventure\Component\Database\Query\QueryInterface;
use Laventure\Component\Database\Schema\Table\TableInterface;

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
    public function parse(ConfigurationInterface $config): static
    {

    }

    /**
     * @inheritDoc
     */
    public function connect(): static
    {
        // TODO: Implement connect() method.
    }

    /**
     * @inheritDoc
     */
    public function transaction(): TransactionInterface
    {
        // TODO: Implement createTransaction() method.
    }

    /**
     * @inheritDoc
     */
    public function table(string $name): TableInterface
    {
        // TODO: Implement table() method.
    }

    /**
     * @inheritDoc
     */
    public function config($id, $default = null): mixed
    {
        // TODO: Implement config() method.
    }

    /**
     * @inheritDoc
     */
    public function getDatabaseFactory(): DatabaseFactoryInterface
    {
        // TODO: Implement getDatabaseFactory() method.
    }

    /**
     * @inheritDoc
     */
    public function getDatabaseCollection(): DatabaseCollectionInterface
    {
        // TODO: Implement getDatabaseCollection() method.
    }

    /**
     * @inheritDoc
     */
    public function getDatabases(): array
    {
        // TODO: Implement getDatabases() method.
    }

    /**
     * @inheritDoc
     */
    public function getDatabaseNames(): array
    {
        // TODO: Implement getDatabaseNames() method.
    }

    /**
     * @inheritDoc
     */
    public function getQueryLogger(): QueryLoggerInterface
    {
        // TODO: Implement getQueryLogger() method.
    }
}
