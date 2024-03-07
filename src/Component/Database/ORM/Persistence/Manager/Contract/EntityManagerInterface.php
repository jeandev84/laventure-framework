<?php

declare(strict_types=1);

namespace Laventure\Component\Database\ORM\Persistence\Manager\Contract;

use Laventure\Component\Database\Connection\ConnectionInterface;
use Laventure\Component\Database\ORM\Persistence\Manager\Config\Configuration;
use Laventure\Component\Database\ORM\Persistence\Manager\Event\EventManagerInterface;
use Laventure\Component\Database\ORM\Persistence\Query\Builder\QueryBuilderInterface;
use Laventure\Component\Database\ORM\Persistence\UnitOfWork\UnitOfWorkInterface;
use Laventure\Component\Database\Query\Builder\SQL\SQLQueryBuilderInterface;
use Laventure\Component\Database\Query\QueryInterface;

/**
 * EntityManagerInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\ORM\Persistence\Manager
*/
interface EntityManagerInterface extends ObjectManagerInterface
{
    /**
     * Determine if entity manager is open
     *
     * @return bool
    */
    public function isOpen(): bool;






    /**
     * reset entity manager
     *
     * @return $this
    */
    public function resetManager(): static;






    /**
     * Begin transaction
     *
     * @return bool
     */
    public function beginTransaction(): bool;









    /**
     * Commit all changes
     *
     * @return bool
    */
    public function commit(): bool;









    /**
     * Rollback commit process
     *
     * @return bool
    */
    public function rollback(): bool;







    /**
     * Transaction
     *
     * @param callable $func
     *
     * @return mixed
    */
    public function transaction(callable $func): mixed;








    /**
     * Returns SQL query builder
     *
     * @return SQLQueryBuilderInterface
     */
    public function createNativeQueryBuilder(): SQLQueryBuilderInterface;








    /**
     * Create native query builder
     *
     * @param string $sql
     * @param array $params
     * @return QueryInterface
    */
    public function createNativeQuery(string $sql, array $params = []): QueryInterface;






    /**
     * Create native sql query builder
     *
     * @return QueryBuilderInterface
    */
    public function createQueryBuilder(): QueryBuilderInterface;








    /**
     * Returns entity manager configuration
     *
     * @return Configuration
    */
    public function getConfiguration(): Configuration;







    /**
     * Returns connection
     *
     * @return ConnectionInterface
    */
    public function getConnection(): ConnectionInterface;







    /**
     * Returns unit of work
     *
     * @return UnitOfWorkInterface
    */
    public function getUnitOfWork(): UnitOfWorkInterface;








    /**
     * Returns entity event manager
     *
     * @return EventManagerInterface
    */
    public function getEventManager(): EventManagerInterface;









    /**
     * Close entity manager
     *
     * @return void
    */
    public function close(): void;
}
