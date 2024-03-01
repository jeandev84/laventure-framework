<?php

declare(strict_types=1);

namespace Laventure\Component\Database\Connection;

use Laventure\Component\Database\Configuration\Contract\ConfigurationInterface;
use Laventure\Component\Database\Connection\Transaction\TransactionInterface;
use Laventure\Component\Database\DatabaseInterface;
use Laventure\Component\Database\Query\Builder\QueryBuilderInterface;
use Laventure\Component\Database\Query\QueryInterface;

/**
 * ConnectionInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\Connection
*/
interface ConnectionInterface extends TransactionInterface
{
    /**
     * Returns the name of connection
     *
     * @return string
    */
    public function getName(): string;






    /**
     * Connect to the database
     *
     * @param ConfigurationInterface $config
     *
     * @return void
    */
    public function connect(ConfigurationInterface $config): void;






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
    public function executeQuery(string $sql): mixed;





    /**
     * Returns database name
     *
     * @return string
    */
    public function getDatabaseName(): string;






    /**
     * Returns configuration credentials
     *
     * @return ConfigurationInterface
    */
    public function getConfiguration(): ConfigurationInterface;




    /**
     * Returns value of given key
     *
     * @param $key
     * @param $default
     * @return mixed
    */
    public function config($key, $default = null): mixed;






    /**
     * Returns instance of database
     *
     * @return DatabaseInterface
    */
    public function getDatabase(): DatabaseInterface;
}
