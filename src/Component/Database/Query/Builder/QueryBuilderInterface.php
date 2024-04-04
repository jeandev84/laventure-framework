<?php

declare(strict_types=1);

namespace Laventure\Component\Database\Query\Builder;

use Laventure\Component\Database\Connection\ConnectionInterface;
use Laventure\Component\Database\Query\Builder\SQL\Conditions\Criteria\HasCriteriaInterface;
use Laventure\Component\Database\Query\Builder\SQL\Criteria\CriteriaInterface;
use Laventure\Component\Database\Query\Builder\SQL\Expr\ExpressionBuilderInterface;
use Laventure\Component\Database\Query\QueryInterface;

/**
 * QueryBuilderInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\Statement\Builder
*/
interface QueryBuilderInterface extends HasCriteriaInterface
{
    /**
     * @return ExpressionBuilderInterface
     */
    public function expr(): ExpressionBuilderInterface;





    /**
     * PgsqlSelectBuilder columns
     *
     * @param $columns
     * @return $this
    */
    public function select($columns = null): static;





    /**
     * PgsqlSelectBuilder distinct values
     *
     * @return $this
    */
    public function distinct(): static;





    /**
     * PgsqlSelectBuilder columns
     *
     * @param $selects
     * @return $this
    */
    public function addSelect($selects): static;







    /**
     * Selected the table
     *
     * @param string $from
     * @param string $alias
     * @return $this
     */
    public function from(string $from, string $alias = ''): static;






    /**
     * @param string $classname
     * @return $this
    */
    public function map(string $classname): static;








    /**
     * joinX table
     * @param string $table
     * @param string $condition
     * @return $this
     */
    public function join(string $table, string $condition): static;







    /**
     * joinX table
     * @param string $table
     * @param string $condition
     * @return $this
     */
    public function leftJoin(string $table, string $condition): static;







    /**
     * joinX table
     * @param string $table
     * @param string $condition
     * @return $this
     */
    public function rightJoin(string $table, string $condition): static;







    /**
     * joinX table
     * @param string $table
     * @param string $condition
     * @return $this
     */
    public function innerJoin(string $table, string $condition): static;








    /**
     * joinX table
     * @param string $table
     * @param string $condition
     * @return $this
     */
    public function fullJoin(string $table, string $condition): static;








    /**
     * @param string $join
     *
     * @return $this
     */
    public function addJoin(string $join): static;










    /**
     * @param string $columns
     *
     * @return $this
     */
    public function groupBy(string $columns): static;







    /**
     * @param string $columns
     *
     * @return $this
     */
    public function addGroupBy(string $columns): static;









    /**
     * @param string $condition
     * @param $type
     * @return $this
    */
    public function addHaving(string $condition, $type = null): static;






    /**
     * @param string $condition
     *
     * @return $this
    */
    public function having(string $condition): static;






    /**
     * @param string $condition
     *
     * @return $this
     */
    public function andHaving(string $condition): static;







    /**
     * @param string $condition
     * @return $this
     */
    public function orHaving(string $condition): static;






    /**
     * @param string $column
     * @param string|null $direction
     *
     * @return $this
    */
    public function orderBy(string $column, string $direction = null): static;






    /**
     * @param array $orders
     * @return $this
    */
    public function addOrderBy(array $orders): static;






    /**
     * Set max results
     *
     * @param $limit
     * @return $this
    */
    public function limit($limit): static;








    /**
     * Set min results
     *
     * @param $offset
     * @return $this
    */
    public function offset($offset): static;







    /**
     * @param string $table
     *
     * @return $this
    */
    public function insert(string $table): static;









    /**
     * @param array $values
     * @return $this
     */
    public function values(array $values): static;








    /**
     * @param string $column
     * @param $value
     * @param int $index
     * @return $this
    */
    public function setValue(string $column, $value, int $index = 0): static;









    /**
     * @param string $table
     * @return $this
    */
    public function update(string $table): static;









    /**
     * @param $column
     * @param $value
     * @return $this
    */
    public function set($column, $value): static;









    /**
     * @param $table
     * @return $this
    */
    public function delete($table): static;











    /**
     * Add WHERE conditions
     *
     * @param $condition
     *
     * @return $this
    */
    public function where($condition): static;








    /**
     * @param $column
     * @param array $value
     * @return $this
    */
    public function whereIn($column, array $value): static;







    /**
     * @param $column
     * @param $value
     * @return $this
    */
    public function whereEqualTo($column, $value): static;








    /**
     * Add WHERE conditions AND
     *
     * @param $condition
     *
     * @return $this
    */
    public function andWhere($condition): static;







    /**
     * Add WHERE conditions OR
     *
     * @param $condition
     *
     * @return $this
    */
    public function orWhere($condition): static;






    /**
     * @param array $parameters
     * @return $this
    */
    public function setParameters(array $parameters): static;





    /**
     * @param $id
     * @param $value
     * @return $this
     */
    public function setParameter($id, $value): static;









    /**
     * Returns criteria
     *
     * @return CriteriaInterface
    */
    public function getCriteria(): CriteriaInterface;







    /**
     * Returns SQL
     *
     * @return string
    */
    public function getSQL(): string;









    /**
     * Returns query
     *
     * @return QueryInterface
    */
    public function getQuery(): QueryInterface;
}
