<?php
declare(strict_types=1);

namespace Laventure\Component\Database\ORM\ActiveRecord\Query;


use Laventure\Component\Database\Connection\ConnectionInterface;

/**
 * QueryBuilderInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\ORM\ActiveRecord\Query
 */
interface QueryBuilderInterface
{

    /**
     * @return string
    */
    public function getClassName(): string;




    /**
     * @return string
    */
    public function getTableName(): string;




    /**
     * @param $columns
     * @return $this
    */
    public function select($columns = null): static;





    /**
     * @return $this
    */
    public function distinct(): static;





    /**
     * @param string $from
     * @param string $alias
     * @return $this
    */
    public function from(string $from, string $alias = ''): static;







    /**
     * @param string $table
     * @param string $condition
     * @return $this
    */
    public function join(string $table, string $condition): static;








    /**
     * @param string $table
     * @param string $condition
     * @return $this
    */
    public function leftJoin(string $table, string $condition): static;








    /**
     * @param string $table
     *
     * @param string $condition
     *
     * @return $this
    */
    public function rightJoin(string $table, string $condition): static;









    /**
     * @param string $table
     *
     * @param string $condition
     *
     * @return $this
    */
    public function innerJoin(string $table, string $condition): static;










    /**
     * @param string $table
     *
     * @param string $condition
     *
     * @return $this
    */
    public function fullJoin(string $table, string $condition): static;






    /**
     * @param string $column
     *
     * @param string|null $direction
     *
     * @return $this
    */
    public function orderBy(string $column, string $direction = null): static;






    /**
     * @param string $column
     *
     * @return $this
    */
    public function groupBy(string $column): static;








    /**
     * @param string $condition
     *
     * @return $this
    */
    public function having(string $condition): static;







    /**
     * @param int $limit
     *
     * @return $this
    */
    public function limit(int $limit): static;









    /**
     * @param int $offset
     *
     * @return $this
    */
    public function offset(int $offset): static;






    /**
     * @param string $column
     *
     * @param $value
     *
     * @param string $operator
     *
     * @return static
    */
    public function where(string $column, $value, string $operator = "="): static;








    /**
     * @param string $column
     *
     * @param $value
     *
     * @param string $operator
     *
     * @return $this
    */
    public function andWhere(string $column, $value, string $operator = "="): static;








    /**
     * @param string $column
     *
     * @param $value
     *
     * @param string $operator
     *
     * @return $this
    */
    public function orWhere(string $column, $value, string $operator = "="): static;








    /**
     * @param string $column
     *
     * @param string $expression
     *
     * @return $this
    */
    public function whereLike(string $column, string $expression): static;







    /**
     * @param string $column
     *
     * @param array $data
     *
     * @return $this
    */
    public function whereIn(string $column, array $data): static;








    /**
     * Returns last inserted id
     *
     * @param array $attributes
     *
     * @return mixed
    */
    public function create(array $attributes): mixed;








    /**
     * @param array $attributes
     *
     * @return false|int
    */
    public function update(array $attributes): mixed;









    /**
     * @return mixed
    */
    public function delete(): mixed;









    /**
     * Fetch one result by criteria
     *
     * @return mixed
    */
    public function one(): mixed;






    /**
     * Fetch all result by criteria
     *
     * @return array
     */
    public function get(): array;






    /**
     * Fetch all result as array
     *
     * @return array
     */
    public function assoc(): array;







    /**
     * Fetch columns
     *
     * @return array
    */
    public function columns(): array;







    /**
     * Returns first result by criteria
     *
     * @return mixed
    */
    public function first(): mixed;






    /**
     * Returns count
     *
     * @return int
    */
    public function count(): int;







    /**
     * Paginate query
     *
     * @param int $page
     * @param int $limit
     * @return array
    */
    public function paginate(int $page, int $limit): array;
}