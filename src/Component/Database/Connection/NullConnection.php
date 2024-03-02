<?php

declare(strict_types=1);

namespace Laventure\Component\Database\Connection;

use Laventure\Component\Database\Configuration\Contract\ConfigurationInterface;
use Laventure\Component\Database\Configuration\NullConfiguration;
use Laventure\Component\Database\Query\Builder\NullQueryBuilder;
use Laventure\Component\Database\Query\Builder\QueryBuilderInterface;
use Laventure\Component\Database\Query\NullQuery;
use Laventure\Component\Database\Query\QueryInterface;
use Laventure\Component\Database\Relational\DatabaseInterface;
use Laventure\Component\Database\Relational\NullDatabase;

/**
 * NullConnection
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\Connection
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
    public function createQueryBuilder(): QueryBuilderInterface
    {
        return new NullQueryBuilder();
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
    public function config($key, $default = null): mixed
    {
        return null;
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
        return false;
    }
}
