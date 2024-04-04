<?php

declare(strict_types=1);

namespace Laventure\Component\Database\ORM\Manager\Contract;

use Laventure\Component\Database\Connection\ConnectionInterface;
use Laventure\Component\Database\ORM\Manager\Config\Configuration;
use Laventure\Component\Database\ORM\Manager\Event\EventManagerInterface;
use Laventure\Component\Database\ORM\Repository\Contract\EntityRepositoryInterface;
use Laventure\Component\Database\ORM\Repository\Contract\ObjectRepositoryInterface;
use Laventure\Component\Database\ORM\UnitOfWork\UnitOfWorkInterface;
use Laventure\Component\Database\Query\Builder\QueryBuilderInterface;
use Laventure\Component\Database\Query\QueryInterface;

/**
 * EntityManagerInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\ORM\Data\Manager
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
     * Add repository
     *
     * @param EntityRepositoryInterface[] $repositories
     * @return $this
    */
    public function addRepositories(array $repositories): static;







    /**
     * Returns all stored repositories
     *
     * @return  EntityRepositoryInterface[]
    */
    public function getRepositories(): array;





    /**
     * Returns entities
     *
     * @return array
    */
    public function getEntities(): array;





    /**
     * Determine if object initialized
     *
     * @param object $object
     * @return bool
    */
    public function initializedObject(object $object): bool;







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
     * @param string $sql
     * @param array $parameters
     * @return QueryInterface
    */
    public function createNativeQuery(string $sql, array $parameters = []): QueryInterface;





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
