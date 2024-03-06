<?php

declare(strict_types=1);

namespace Laventure\Component\Database\ORM\Mapper;

/**
 * DataMapperInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\ORM\DataMapper
*/
interface DataMapperInterface
{
    /**
     * Find data by ID (SELECT BY ID)
     *
     * @param $id
     *
     * @return object|null
    */
    public function findById($id): ?object;






    /**
     * Save data (INSERT or UPDATE)
     *
     * @param object $object
     *
     * @return int
    */
    public function save(object $object): int;






    /**
     * MysqlDeleteBuilder data
     *
     * @param object $object
     *
     * @return bool
    */
    public function delete(object $object): bool;
}
