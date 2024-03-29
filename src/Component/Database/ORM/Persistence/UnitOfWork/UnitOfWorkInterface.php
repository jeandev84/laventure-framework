<?php

declare(strict_types=1);

namespace Laventure\Component\Database\ORM\Persistence\UnitOfWork;

use Laventure\Component\Database\ORM\Persistence\Mapper\Data\DataMapperInterface;
use Laventure\Component\Database\ORM\Persistence\Mapper\Identity\IdentityMapperInterface;
use Laventure\Component\Database\ORM\Persistence\PersistentInterface;
use Laventure\Component\Database\ORM\Persistence\Storage\ObjectStorage;

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
     * Register object state
     *
     * @param object $object
     * @param $state
     * @return mixed
    */
    public function registerObject(object $object, $state): mixed;





    /**
     * Register NEW state
     *
     * @param object $object
     * @return $this
    */
    public function registerNew(object $object): static;






    /**
     * Register MANAGED state
     *
     * @param object $object
     * @return $this
    */
    public function registerManaged(object $object): static;






    /**
     * Register DETACHED state
     *
     * @param object $object
     * @return $this
    */
    public function registerDetached(object $object): static;







    /**
     * Register REMOVED state
     *
     * @param object $object
     * @return $this
    */
    public function registerRemoved(object $object): static;






    /**
     * Register NEW or MANAGED state object
     *
     * @param object $object
     * @return $this
    */
    public function registerPersist(object $object): static;






    /**
     * Find record by given ID
     *
     * @param $class
     * @param $id
     * @return mixed
    */
    public function find($class, $id): mixed;






    /**
     * Register state NEW or UPDATE
     *
     * @param object $object
     *
     * @return mixed
     */
    public function persist(object $object): mixed;







    /**
     * Register state REMOVED
     *
     * @param object $object
     *
     * @return mixed
    */
    public function remove(object $object): mixed;







    /**
     * Refresh object
     *
     * @param object $object
     *
     * @return mixed
    */
    public function refresh(object $object): mixed;








    /**
     * Add object to the storage
     *
     * @param object $object
     *
     * @return mixed
    */
    public function attach(object $object): mixed;







    /**
     * Remove object from the storage
     *
     * @param object $object
     *
     * @return mixed
    */
    public function detach(object $object): mixed;








    /**
     * Add object to previous collection
     *
     * @param object $object
     *
     * @return mixed
    */
    public function merge(object $object): mixed;








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
     * @return mixed
    */
    public function commit(): mixed;








    /**
     * Returns storage
     *
     * @return ObjectStorage
    */
    public function getStorage(): ObjectStorage;






    /**
     * Returns persistent object
     *
     * @param $class
     * @return PersistentInterface
    */
    public function getPersistent($class): PersistentInterface;







    /**
     * Returns data mapper
     *
     * @return DataMapperInterface
    */
    public function getDataMapper(): DataMapperInterface;









    /**
     * Returns identity mapper
     *
     * @return IdentityMapperInterface
     */
    public function getIdentityMap(): IdentityMapperInterface;
}
