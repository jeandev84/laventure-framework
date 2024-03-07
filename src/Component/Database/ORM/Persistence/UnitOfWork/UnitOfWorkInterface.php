<?php

declare(strict_types=1);

namespace Laventure\Component\Database\ORM\Persistence\UnitOfWork;

use Laventure\Component\Database\ORM\Persistence\PersistentInterface;

/**
 * UnitOfWorkInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\ORM\UnitOfWork
*/
interface UnitOfWorkInterface
{
    /**
     * Register state
     *
     * @param object $object
     * @param $state
     * @return mixed
    */
    public function registerState(object $object, $state): mixed;







    /**
     * Find storage object
     *
     * @param int $id
     *
     * @return object|null
    */
    public function find(int $id): ?object;








    /**
     * Register state NEW or UPDATE
     *
     * @param object $object
     *
     * @return void
    */
    public function persist(object $object): void;








    /**
     * Register state REMOVED
     *
     * @param object $object
     *
     * @return void
    */
    public function remove(object $object): void;







    /**
     * Refresh object
     *
     * @param object $object
     *
     * @return void
    */
    public function refresh(object $object): void;








    /**
     * Add object to the storage
     *
     * @param object $object
     *
     * @return void
    */
    public function attach(object $object): void;







    /**
     * Remove object from the storage
     *
     * @param object $object
     *
     * @return void
    */
    public function detach(object $object): void;








    /**
     * Add object to previous collection
     *
     * @param object $object
     *
     * @return void
    */
    public function merge(object $object): void;








    /**
     * Determine if object in storage
     *
     * @param object $object
     *
     * @return bool
    */
    public function contains(object $object): bool;







    /**
     * @param object $object
     * @return bool
    */
    public function isNew(object $object): bool;








    /**
     * Clear all object from the storage
     *
     * @return void
    */
    public function clear(): void;








    /**
     * Commit changes
     *
     * @return void
    */
    public function commit(): void;





    /**
     * Returns persistent object
     *
     * @param string|object $class
     * @return PersistentInterface
    */
    public function getPersistent($class): PersistentInterface;
}
