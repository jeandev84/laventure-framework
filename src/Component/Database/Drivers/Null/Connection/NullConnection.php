<?php
declare(strict_types=1);

namespace Laventure\Component\Database\Drivers\Null\Connection;

use Laventure\Component\Database\Collection\Contract\DatabaseCollectionInterface;
use Laventure\Component\Database\Connection\Connection;
use Laventure\Component\Database\Connection\Transaction\Contract\TransactionInterface;
use Laventure\Component\Database\Factory\DatabaseFactoryInterface;
use Laventure\Component\Database\Query\Builder\QueryBuilderInterface;
use Laventure\Component\Database\Query\QueryInterface;
use Laventure\Component\Database\Schema\Table\TableInterface;

/**
 * NullConnection
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\Drivers\Null
 */
class NullConnection extends Connection
{

    /**
     * @inheritDoc
     */
    public function makeSureIsAvailable(): void
    {
        // TODO: Implement makeSureIsAvailable() method.
    }

    /**
     * @inheritDoc
     */
    public function connectWithoutDatabase(): static
    {
        // TODO: Implement connectWithoutDatabase() method.
    }

    /**
     * @inheritDoc
     */
    public function connectIfDatabaseExists(): static
    {
        // TODO: Implement connectIfDatabaseExists() method.
    }

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
    public function connected(): bool
    {
        // TODO: Implement connected() method.
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
    public function createQueryBuilder(): QueryBuilderInterface
    {
        // TODO: Implement createQueryBuilder() method.
    }

    /**
     * @inheritDoc
     */
    public function transaction(): TransactionInterface
    {
        // TODO: Implement transaction() method.
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
    public function getDatabaseNames(): array
    {
        // TODO: Implement getDatabaseNames() method.
    }
}