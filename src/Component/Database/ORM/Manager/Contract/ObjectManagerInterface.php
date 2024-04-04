<?php

declare(strict_types=1);

namespace Laventure\Component\Database\ORM\Manager\Contract;

use Laventure\Component\Database\ORM\Mapping\ClassMetadataInterface;
use Laventure\Component\Database\ORM\Mapping\Factory\ClassMetadataFactoryInterface;
use Laventure\Component\Database\ORM\Repository\Contract\ObjectRepositoryInterface;

/**
 * ObjectManagerInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\ORM\Data\Manager
*/
interface ObjectManagerInterface
{
    /**
     * Initialize object
     *
     * @param object $object
     * @return mixed
    */
    public function initializeObject(object $object): mixed;





    /**
     * @param string $classname
     * @param $id
     * @return object|null
    */
    public function find(string $classname, $id): mixed;








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
     * Determine if object in storage
     *
     * @param object $object
     *
     * @return bool
    */
    public function contains(object $object): bool;







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
     * @return mixed
    */
    public function refresh(object $object): mixed;










    /**
     * Flush changes
     *
     * @return void
    */
    public function flush(): void;









    /**
     * Tells manager remove all objects in storage
     *
     * @return void
    */
    public function clear(): void;







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
     * @return ClassMetadataFactoryInterface
    */
    public function getMetadataFactory(): ClassMetadataFactoryInterface;
}
