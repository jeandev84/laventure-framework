<?php

declare(strict_types=1);

namespace Laventure\Component\Database\ORM\UnitOfWork;

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

    const STATE_MANAGED   = 1;
    const STATE_NEW       = 2;
    const STATE_DETACHED  = 3;
    const STATE_REMOVED   = 4;




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
     * Commit changes
     *
     * @return void
    */
    public function commit(): void;
}
