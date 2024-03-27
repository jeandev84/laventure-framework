<?php
declare(strict_types=1);

namespace Laventure\Component\Database\ORM\ActiveRecord\Repository;


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
     * @param $columns
     * @return QueryBuilderInterface
    */
    public static function select($columns = null): QueryBuilderInterface;






    /**
     * @param string $column
     * @param $value
     * @param string $operator
     * @return QueryBuilderInterface
    */
    public static function where(string $column, $value, string $operator = "="): QueryBuilderInterface;








    /**
     * @param string $column
     * @param string|null $direction
     * @return QueryBuilderInterface
    */
    public static function orderBy(string $column, string $direction = null): QueryBuilderInterface;








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
}