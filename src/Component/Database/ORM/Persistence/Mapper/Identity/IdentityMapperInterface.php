<?php

declare(strict_types=1);

namespace Laventure\Component\Database\ORM\Persistence\Mapper\Identity;

use SplObjectStorage;

/**
 * IdentityMapperInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\ORM\Mapper\Identity
*/
interface IdentityMapperInterface
{
    /**
     * @param $id
     * @param $data
     * @return mixed
    */
    public function map($id, $data): mixed;






    /**
     * Determine if exists ID in storage
     *
     * @param $id
     * @return bool
    */
    public function has($id): bool;






    /**
     * Returns data by given ID
     *
     * @param $id
     * @return mixed
    */
    public function get($id): mixed;







    /**
     * @return SplObjectStorage
    */
    public function all(): SplObjectStorage;







    /**
     * Returns identity ID
     *
     * @param $class
     * @param $id
     * @return mixed
    */
    public function generateId($class, $id): mixed;
}
