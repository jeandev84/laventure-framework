<?php
declare(strict_types=1);

namespace Laventure\Component\Database\ORM\DataMapper;

/**
 * AbstractMapper
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\ORM\Persistence\DataMapper
*/
abstract class AbstractMapper implements DataMapperInterface
{
    /**
     * Update data and returns updated ID
     *
     * @param object $object
     * @return int
    */
    abstract public function update(object $object): int;






    /**
     * Insert data and returns last insert ID
     *
     * @param object $object
     * @return int
    */
    abstract public function insert(object $object): int;
}