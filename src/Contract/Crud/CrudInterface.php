<?php

declare(strict_types=1);

namespace Laventure\Contract\Crud;

/**
 * CrudInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Contract\Crud
*/
interface CrudInterface
{
    /**
     * Create data from given $attributes
     *
     * @param array $attributes
     * @return int
    */
    public function create(array $attributes): int;





    /**
     * Read some data from given $id
     *
     * @param $id
     *
     * @return mixed
    */
    public function read($id): mixed;





    /**
     * Update some data from given $attributes and $id
     *
     * @param array $attributes
     * @param $id
     * @return mixed
    */
    public function update(array $attributes, $id): mixed;






    /**
     * Delete some data from given $id
     *
     * @param $id
     * @return mixed
    */
    public function delete($id): mixed;
}
