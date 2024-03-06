<?php

declare(strict_types=1);

namespace Laventure\Component\Database\ORM\Persistence\Crud;

/**
 * CrudInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\ORM\Crud
*/
interface CrudInterface
{
    /**
     * Create a new record and returns the last insert ID
     *
     * @param array $attributes
     * @return int
    */
    public function create(array $attributes): int;



    /**
     * Read a record by given $id
     *
     * @param $id
     *
     * @return mixed
    */
    public function read($id): mixed;





    /**
     * MysqlUpdateBuilder a record by given $id
     *
     * @param array $attributes
     * @param $id
     * @return mixed
    */
    public function update(array $attributes, $id): mixed;






    /**
     * MysqlDeleteBuilder a record by given $id
     *
     * @param $id
     * @return mixed
    */
    public function delete($id): mixed;
}
