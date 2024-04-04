<?php

declare(strict_types=1);

namespace Laventure\Component\Database\ORM\Mapper\Data;

use Laventure\Component\Database\ORM\Mapper\Identity\IdentityMapperInterface;

/**
 * DataMapperInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\ORM\Data\Data
*/
interface DataMapperInterface
{
    /**
     * Retrieve data by given $id
     *
     * Example:
     *   $em->getUnitOfWork()
     *      ->getDataMapper()
     *      ->find(User::class, 1)
     *
     * @param $class
     * @param $id
     *
     * @return object|null
    */
    public function find($class, $id): ?object;







    /**
     * Insert data
     *
     * Example:
     *  $em->getUnitOfWork()
     *     ->getDataMapper()
     *     ->insert($user)
     *
     * @param object $object
     * @return int
    */
    public function insert(object $object): int;








    /**
     * Update data
     *
     * $em->getUnitOfWork()
     *    ->getDataMapper()
     *    ->update($user);
     *
     * @param object $object
     * @return int
    */
    public function update(object $object): int;








    /**
     * Insert / Update data
     *
     * Example:
     *   $em->getUnitOfWork()
     *      ->getDataMapper()
     *      ->save($user);
    */
    public function save(object $object): int;






    /**
     * Delete record
     *
     *  Example:
     *     $em->getUnitOfWork()
     *        ->getDataMapper()
     *        ->delete($user);
     *
     * @param object $object
     *
     * @return bool
    */
    public function delete(object $object): bool;









    /**
     * Returns identity mapper
     *
     * @return IdentityMapperInterface
    */
    public function getIdentityMap(): IdentityMapperInterface;
}
