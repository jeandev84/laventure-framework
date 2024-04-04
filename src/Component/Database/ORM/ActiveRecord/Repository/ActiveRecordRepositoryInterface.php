<?php

declare(strict_types=1);

namespace Laventure\Component\Database\ORM\ActiveRecord\Repository;

use Laventure\Component\Database\Connection\ConnectionInterface;
use Laventure\Component\Database\Manager\Contract\DatabaseManagerInterface;
use Laventure\Component\Database\ORM\ActiveRecord\Exception\ActiveRecordException;
use Laventure\Component\Database\ORM\ActiveRecord\Query\Builder;

/**
 * ActiveRecordRepositoryInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\ORM\ActiveRecord\Repository
*/
interface ActiveRecordRepositoryInterface
{
    /**
     * @return Builder
    */
    public static function query(): Builder;





    /**
     * Returns one record by identifier given value
     *
     * @param int $id
     *
     * @return mixed
    */
    public static function find(int $id): mixed;







    /**
     * Returns all records
     *
     * @return array
    */
    public static function all(): array;








    /**
     * Create a new records and returns the last insert id
     *
     * @param array $attributes
     * @return int
    */
    public static function create(array $attributes): int;








    /**
     * Update record and returns id
     *
     * @param array $attributes
     *
     * @return int
    */
    public function update(array $attributes): int;







    /**
     * Delete one record by current id
     *
     * @return bool
    */
    public function delete(): bool;







    /**
     * Save record
     *
     * @return int
    */
    public function save(): int;










    /**
     * @return ConnectionInterface
    */
    public function getConnection(): ConnectionInterface;







    /**
     * @param string $name
     * @param array $arguments
     * @return void
     * @throws ActiveRecordException
    */
    public static function __callStatic(string $name, array $arguments);
}
