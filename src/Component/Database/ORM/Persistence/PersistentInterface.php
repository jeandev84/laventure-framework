<?php

declare(strict_types=1);

namespace Laventure\Component\Database\ORM\Persistence;

use Laventure\Component\Database\ORM\Mapping\ClassMetadataInterface;
use Laventure\Component\Database\Query\Builder\QueryBuilderInterface;

/**
 * PersistentInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\ORM\Data
*/
interface PersistentInterface
{


    /**
     * Find object from database or from identity map
     *
     * @param $id
     * @return mixed
    */
    public function find($id): mixed;









    /**
     * Add insert data
     *
     * @param array $attributes
     * @return $this
    */
    public function addInsert(array $attributes): static;








    /**
     * Insert data to the table and returns last insert ID
     *
     * @return int
    */
    public function insert(): int;









    /**
     * @param $id
     * @param array $attributes
     * @return static
    */
    public function addUpdate($id, array $attributes): static;







    /**
     * Update data by given id
     *
     * @param $id
     * @param array $attributes
     * @return mixed
    */
    public function refresh($id, array $attributes): mixed;






    /**
     * Update data
     *
     * @return mixed
    */
    public function update(): mixed;









    /**
     * @param $id
     * @return $this
    */
    public function addRemove($id): static;







    /**
     * @param $id
     * @return mixed
    */
    public function delete($id): mixed;








    /**
     * Delete data
     *
     * @return mixed
    */
    public function remove(): mixed;
}
