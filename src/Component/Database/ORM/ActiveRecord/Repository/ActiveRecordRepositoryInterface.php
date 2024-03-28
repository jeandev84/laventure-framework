<?php
declare(strict_types=1);

namespace Laventure\Component\Database\ORM\ActiveRecord\Repository;


use Laventure\Component\Database\Connection\ConnectionInterface;
use Laventure\Component\Database\Manager\Contract\DatabaseManagerInterface;
use Laventure\Component\Database\ORM\ActiveRecord\Exception\ActiveRecordException;
use Laventure\Component\Database\ORM\ActiveRecord\Query\QueryBuilderInterface;

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
     * @return QueryBuilderInterface
    */
    public static function query(): QueryBuilderInterface;




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
     * @param array $attributes
     *
     * @return int
    */
    public static function create(array $attributes): int;








    /**
     * @param array $attributes
     *
     * @return int
    */
    public function update(array $attributes): int;









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