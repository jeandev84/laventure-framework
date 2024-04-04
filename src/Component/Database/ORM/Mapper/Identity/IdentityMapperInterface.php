<?php

declare(strict_types=1);

namespace Laventure\Component\Database\ORM\Mapper\Identity;

/**
 * IdentityMapperInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\ORM\Data\Identity
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
     * Remove Identity
     *
     * @param $id
     * @return mixed
    */
    public function remove($id): mixed;









    /**
     * Returns data by given ID
     *
     * @param $id
     * @return mixed
    */
    public function get($id): mixed;







    /**
     * @return mixed
    */
    public function all(): mixed;






    /**
     * Remove all identity mapped
     *
     * @return void
    */
    public function clear(): void;
}
