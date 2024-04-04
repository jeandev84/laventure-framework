<?php

declare(strict_types=1);

namespace Laventure\Component\Database\Connection;

use Laventure\Component\Database\Collection\Contract\DatabaseCollectionInterface;
use Laventure\Component\Database\Configuration\Contract\ConfigurationInterface;
use Laventure\Component\Database\Connection\Transaction\Contract\TransactionInterface;
use Laventure\Component\Database\DatabaseInterface;
use Laventure\Component\Database\Factory\DatabaseFactoryInterface;
use Laventure\Component\Database\Query\Builder\QueryBuilderInterface;
use Laventure\Component\Database\Query\Logger\QueryLoggerInterface;
use Laventure\Component\Database\Query\QueryInterface;
use Laventure\Component\Database\Schema\Table\TableInterface;

/**
 * ConnectionInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\PdoConnection
*/
interface ConnectionInterface
{
    /**
     * Returns the name of connection
     *
     * @return string
    */
    public function getName(): string;






    /**
     * Parse configuration
     *
     * @param ConfigurationInterface $config
     * @return $this
    */
    public function parse(ConfigurationInterface $config): static;







    /**
     * Connect to the database
     *
     * @return mixed
    */
    public function connect(): static;








    /**
     * Determine if connection established
     *
     * @return bool
     */
    public function connected(): bool;







    /**
     * Disconnect to the database
     *
     * @return void
    */
    public function disconnect(): void;








    /**
     * Purge connection
     *
     * @return void
    */
    public function purge(): void;







    /**
     * Determine if connection is not established
     *
     * @return bool
    */
    public function disconnected(): bool;






    /**
     * Returns connection driver like PDO, mysqli ...
     *
     * @return mixed
    */
    public function getConnection(): mixed;






    /**
     * Returns instance of query
     *
     * @return QueryInterface
    */
    public function createQuery(): QueryInterface;








    /**
     * Returns instance of query builder
     *
     * @return QueryBuilderInterface
    */
    public function createQueryBuilder(): QueryBuilderInterface;







    /**
     * Returns instance of Transaction
     *
     * @return TransactionInterface
    */
    public function transaction(): TransactionInterface;









    /**
     * Create table
     *
     * @param string $name
     * @return TableInterface
    */
    public function table(string $name): TableInterface;










    /**
     * Create a statement prepared or not
     *
     * @param string $sql
     *
     * @return QueryInterface
    */
    public function statement(string $sql): QueryInterface;









    /**
     * Execute query
     *
     * @param string $sql
     *
     * @return int|bool
    */
    public function executeQuery(string $sql): int|bool;









    /**
     * @param $id
     * @param $default
     * @return mixed
    */
    public function config($id, $default = null): mixed;









    /**
     * Returns configuration credentials
     *
     * @return ConfigurationInterface
    */
    public function getConfiguration(): ConfigurationInterface;








    /**
     * Returns instance of database
     *
     * @return DatabaseInterface
    */
    public function getDatabase(): DatabaseInterface;







    /**
     * Returns database factory
     *
     * @return DatabaseFactoryInterface
    */
    public function getDatabaseFactory(): DatabaseFactoryInterface;








    /**
     * Returns all databases
     *
     * @return DatabaseCollectionInterface
    */
    public function getDatabaseCollection(): DatabaseCollectionInterface;









    /**
     * @return DatabaseInterface[]
    */
    public function getDatabases(): array;









    /**
     * Returns database name
     *
     * @return string
    */
    public function getDatabaseName(): string;








    /**
     * Returns database names from database
     *
     * @return array
    */
    public function getDatabaseNames(): array;








    /**
     * Returns query logger
     *
     * @return QueryLoggerInterface
    */
    public function getQueryLogger(): QueryLoggerInterface;
}
