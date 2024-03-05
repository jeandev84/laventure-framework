<?php

declare(strict_types=1);

namespace Laventure\Component\Database\ORM\Persistence\Manager;

use Laventure\Component\Database\ORM\Metadata\ClassMetadataInterface;
use Laventure\Component\Database\ORM\Persistence\Repository\EntityRepositoryInterface;
use Laventure\Component\Database\ORM\Persistence\Repository\ObjectRepositoryInterface;

/**
 * ObjectManagerInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\ORM\Persistence\Manager
*/
interface ObjectManagerInterface
{


    /**
     * @param string $entity
     * @param $id
     * @return object|null
    */
    public function find(string $entity, $id): ?object;






    /**
     *  Tells the manager must save and object in storage
     *
     * @param object $object
     *
     * @return void
    */
    public function persist(object $object): void;






    /**
     * Tells the manager to removes an instance
     *
     * @param object $object
     *
     * @return void
    */
    public function remove(object $object): void;









    /**
     * Tells manager remove all objects in storage
     *
     * @return void
    */
    public function clear(): void;









    /**
     * Tells the manager must detach an object from the storage
     *
     * @param object $object
     *
     * @return void
    */
    public function detach(object $object): void;






    /**
     * Tells manager to refresh an instance
     *
     * @param object $object
     *
     * @return void
    */
    public function refresh(object $object): void;






    /**
     * Flush changes
     *
     * @return void
    */
    public function flush(): void;







    /**
     * Returns entity repository
     *
     * @param string $entity
     * @return ObjectRepositoryInterface
    */
    public function getRepository(string $entity): ObjectRepositoryInterface;







    /**
     * Returns class metadata
     *
     * @param $entity
     * @return ClassMetadataInterface
    */
    public function getClassMetadata($entity): ClassMetadataInterface;








    /**
     * Returns metadata factory
     *
     * @return mixed
    */
    public function getMetadataFactory(): mixed;







    /**
     * Initialize object
     *
     * @param $object
     * @return mixed
    */
    public function initializeObject($object): mixed;



    /**
     * Determine if object in storage
     *
     * @param object $object
     *
     * @return bool
    */
    public function contains(object $object): bool;
}
