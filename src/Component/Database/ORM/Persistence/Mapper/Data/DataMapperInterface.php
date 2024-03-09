<?php

declare(strict_types=1);

namespace Laventure\Component\Database\ORM\Persistence\Mapper\Data;

use Laventure\Component\Database\ORM\Persistence\Mapper\Identity\IdentityMapperInterface;

/**
 * DataMapperInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\ORM\Mapper\Data
*/
interface DataMapperInterface
{
    /**
     * Retrieve data by given id
     *
     * @param $class
     * @param $id
     *
     * @return object|null
    */
    public function find($class, $id): mixed;







    /**
     * Save data (INSERT or UPDATE)
     *
     * @param object $object
     *
     * @return int
    */
    public function save(object $object): int;






    /**
     * DELETE record
     *
     * @param object $object
     *
     * @return bool
    */
    public function delete(object $object): bool;
}
