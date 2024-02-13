<?php
declare(strict_types=1);

namespace Laventure\Component\Database\Query\Builder;

use Laventure\Component\Database\Builder\SQL\Conditions\Contract\HasConditionInterface;
use Laventure\Component\Database\Builder\SQL\DML\Update\UpdateBuilderInterface;
use Laventure\Component\Database\Builder\SQL\DQL\Select\SelectBuilderInterface;
use Laventure\Component\Database\Builder\SQL\ExpressionInterface;
use Laventure\Component\Database\Connection\ConnectionInterface;
use Laventure\Component\Database\Query\QueryInterface;


/**
 * QueryBuilderInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\Query\Builder
*/
interface QueryBuilderInterface
{

    /**
     * @return ExpressionInterface
    */
    public function expr(): ExpressionInterface;




    /**
     * Select columns
     *
     * @param string|null $columns
     *
     * @return $this
     */
    public function select(string $columns = null): static;





    /**
     * Select columns
     *
     * @param string $columns
     * @return $this
     */
    public function addSelect(string $columns): static;




    /**
     * Selected the table
     *
     * @param string $from
     * @param string $alias
     * @return $this
     */
    public function from(string $from, string $alias = ''): static;




    /**
     * Selection tables
     *
     * @param string $from
     * @return $this
     */
    public function addFrom(string $from): static;






    /**
     * Join table
     * @param string $table
     * @param string $condition
     * @return $this
     */
    public function join(string $table, string $condition): static;







    /**
     * Join table
     * @param string $table
     * @param string $condition
     * @return $this
     */
    public function leftJoin(string $table, string $condition): static;







    /**
     * Join table
     * @param string $table
     * @param string $condition
     * @return $this
     */
    public function rightJoin(string $table, string $condition): static;







    /**
     * Join table
     * @param string $table
     * @param string $condition
     * @return $this
     */
    public function innerJoin(string $table, string $condition): static;








    /**
     * Join table
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
     * @param string ...$columns
     * @return $this
     */
    public function groupBy(string ...$columns): static;







    /**
     * @param string ...$columns
     * @return $this
     */
    public function addGroupBy(string ...$columns): static;








    /**
     * @param string $condition
     * @return $this
     */
    public function having(string $condition): static;






    /**
     * @param string $condition
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
     * @return $this
     */
    public function orderBy(string $column, string $direction = null): static;





    /**
     * @param string ...$orders
     * @return $this
     */
    public function addOrderBy(string ...$orders): static;






    /**
     * Set max results
     *
     * @param $limit
     * @return $this
    */
    public function setMaxResults($limit): static;





    /**
     * Set min results
     *
     * @param $offset
     * @return $this
    */
    public function setFirstResult($offset): static;






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
     * @param string $alias
     * @return $this
    */
    public function update(string $table, string $alias = ''): static;







    /**
     * @param $column
     * @param $value
     * @return $this
    */
    public function set($column, $value): static;







    /**
     * @param string $table
     * @param string $alias
     * @return $this
    */
    public function delete(string $table, string $alias = ''): static;







    /**
     * @param string $condition
     *
     * @return $this
     */
    public function where(string $condition): static;





    /**
     * @param string $condition
     * @return $this
     */
    public function andWhere(string $condition): static;






    /**
     * @param string $condition
     * @return $this
    */
    public function orWhere(string $condition): static;







    /**
     * @param array $criteria
     * @return $this
    */
    public function criteria(array $criteria): static;







    /**
     * @return string
    */
    public function getSQL(): string;





    /**
     * @param $id
     * @param $value
     * @param $type
     * @return $this
    */
    public function bindParam($id, $value, $type = null): static;






    /**
     * @param $id
     * @param $value
     * @return $this
    */
    public function setParameter($id, $value): static;






    /**
     * @param $id
     * @return mixed
    */
    public function getParameter($id): mixed;






    /**
     * @param array $parameters
     * @return $this
    */
    public function setParameters(array $parameters): static;






    /**
     * @return array
    */
    public function getParameters(): array;





    /**
     * @return ConnectionInterface
    */
    public function getConnection(): ConnectionInterface;





    /**
     * @return QueryInterface
    */
    public function getQuery(): QueryInterface;

}