<?php

declare(strict_types=1);

namespace Laventure\Component\Database\Query\Crud;

/**
 * CrudInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\Query\Crud
 */
interface CrudInterface
{
    /**
     * @param array $attributes
     * @return mixed
    */
    public function create(array $attributes): mixed;



    /**
     * @param $id
     *
     * @return mixed
    */
    public function read($id): mixed;





    /**
     * @param array $attributes
     * @param $id
     * @return mixed
    */
    public function update(array $attributes, $id): mixed;






    /**
     * @param $id
     * @return mixed
    */
    public function delete($id): mixed;
}
