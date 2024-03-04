<?php
declare(strict_types=1);

namespace Laventure\Component\Database\Connection\Drivers\SqlServer;

use Laventure\Component\Database\Configuration\Contract\ConfigurationInterface;
use Laventure\Component\Database\Connection\ConnectionInterface;
use Laventure\Component\Database\Connection\Query\Builder\SQLQueryBuilderInterface;
use Laventure\Component\Database\Connection\Query\QueryInterface;
use Laventure\Component\Database\DatabaseInterface;
use Laventure\Component\Database\Schema\Table\TableInterface;

/**
 * SqlServerConnection
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\Connection\Drivers\SqlServer
*/
class SqlServerConnection implements ConnectionInterface
{

    /**
     * @inheritDoc
     */
    public function getName(): string
    {
        // TODO: Implement getName() method.
    }

    /**
     * @inheritDoc
     */
    public function connect(ConfigurationInterface $config): void
    {
        // TODO: Implement connect() method.
    }

    /**
     * @inheritDoc
     */
    public function connected(): bool
    {
        // TODO: Implement connected() method.
    }

    /**
     * @inheritDoc
     */
    public function disconnect(): void
    {
        // TODO: Implement disconnect() method.
    }

    /**
     * @inheritDoc
     */
    public function purge(): void
    {
        // TODO: Implement purge() method.
    }

    /**
     * @inheritDoc
     */
    public function disconnected(): bool
    {
        // TODO: Implement disconnected() method.
    }

    /**
     * @inheritDoc
     */
    public function getConnection(): mixed
    {
        // TODO: Implement getConnection() method.
    }

    /**
     * @inheritDoc
     */
    public function createQuery(): QueryInterface
    {
        // TODO: Implement createQuery() method.
    }

    /**
     * @inheritDoc
     */
    public function createQueryBuilder(): SQLQueryBuilderInterface
    {
        // TODO: Implement createQueryBuilder() method.
    }

    /**
     * @inheritDoc
     */
    public function createTable(string $name, string $schemaName = ''): TableInterface
    {
        // TODO: Implement createTable() method.
    }

    /**
     * @inheritDoc
     */
    public function statement(string $sql): QueryInterface
    {
        // TODO: Implement statement() method.
    }

    /**
     * @inheritDoc
     */
    public function executeQuery(string $sql): mixed
    {
        // TODO: Implement executeQuery() method.
    }

    /**
     * @inheritDoc
     */
    public function getDatabaseName(): string
    {
        // TODO: Implement getDatabaseName() method.
    }

    /**
     * @inheritDoc
     */
    public function configuration(): ConfigurationInterface
    {
        // TODO: Implement configuration() method.
    }

    /**
     * @inheritDoc
     */
    public function config($key, $default = null): mixed
    {
        // TODO: Implement config() method.
    }

    /**
     * @inheritDoc
     */
    public function getDatabase(): DatabaseInterface
    {
        // TODO: Implement getDatabase() method.
    }

    /**
     * @inheritDoc
     */
    public function activateTransaction(): void
    {
        // TODO: Implement activateTransaction() method.
    }

    /**
     * @inheritDoc
     */
    public function beginTransaction(): bool
    {
        // TODO: Implement beginTransaction() method.
    }

    /**
     * @inheritDoc
     */
    public function hasActiveTransaction(): bool
    {
        // TODO: Implement hasActiveTransaction() method.
    }

    /**
     * @inheritDoc
     */
    public function commit(): bool
    {
        // TODO: Implement commit() method.
    }

    /**
     * @inheritDoc
     */
    public function rollback(): bool
    {
        // TODO: Implement rollback() method.
    }

    /**
     * @inheritDoc
     */
    public function transaction(callable $func): mixed
    {
        // TODO: Implement transaction() method.
    }

    /**
     * @inheritDoc
     */
    public function transactionIf(callable $func, bool $condition = false): mixed
    {
        // TODO: Implement transactionIf() method.
    }

    /**
     * @inheritDoc
     */
    public function disableTransaction(): void
    {
        // TODO: Implement disableTransaction() method.
    }
}