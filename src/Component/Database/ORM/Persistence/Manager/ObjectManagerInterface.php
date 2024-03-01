<?php

declare(strict_types=1);

namespace Laventure\Component\Database\ORM\Persistence\Manager;

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
     * Determine if object in storage
     *
     * @param object $object
     *
     * @return bool
    */
    public function contains(object $object): bool;








    /**
     * Tells manager remove all objects in storage
     *
     * @return void
    */
    public function clear(): void;
}
