<?php
declare(strict_types=1);

namespace Laventure\Component\Database\ORM\DataMapper;


/**
 * DataMapperInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\ORM\Persistence\DataMapper
*/
interface DataMapperInterface
{
    /**
     * Find data
     *
     * @param int $id
     *
     * @return object|null
    */
    public function find(int $id): ?object;






    /**
     * Save data
     *
     * @param object $object
     *
     * @return int
    */
    public function save(object $object): int;






    /**
     * Delete data
     *
     * @param object $object
     *
     * @return bool
    */
    public function delete(object $object): bool;
}