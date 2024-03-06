<?php

declare(strict_types=1);

namespace Laventure\Component\Database\ORM\Persistence\Mapper;

use Laventure\Component\Database\ORM\Mapper\DataMapperInterface;

/**
 * DataMapper
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\ORM\Persistence\Mapper
*/
class DataMapper implements DataMapperInterface
{
    /**
     * @inheritDoc
    */
    public function findById($id): ?object
    {

    }





    /**
     * @inheritDoc
    */
    public function save(object $object): int
    {

    }




    /**
     * @inheritDoc
    */
    public function delete(object $object): bool
    {

    }




    /**
      * PgsqlUpdateBuilder data and returns updated ID
      *
      * @param object $object
      * @return int
     */
    public function update(object $object): int
    {

    }






    /**
     * PgsqlInsertBuilder data and returns last insert ID
     *
     * @param object $object
     * @return int
    */
    public function insert(object $object): int
    {

    }
}
