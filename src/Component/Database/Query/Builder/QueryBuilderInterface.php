<?php
declare(strict_types=1);

namespace Laventure\Component\Database\Query\Builder;

use Laventure\Component\Database\Builder\SQL\Criteria\HasCriteriaInterface;
use Laventure\Component\Database\Builder\SQL\ExpressionInterface;
use Laventure\Component\Database\Connection\ConnectionInterface;
use Laventure\Component\Database\Query\QueryInterface;
use Laventure\Component\Database\Query\Result\QueryResultInterface;

/**
 * BuilderInterfaceHas
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\Query\Builder
*/
interface QueryBuilderInterface extends HasCriteriaInterface
{
    /**
     * @return ExpressionInterface
    */
    public function expr(): ExpressionInterface;





    /**
     * Select query
     * @param string|null $columns
    */
    public function select(string $columns = null, bool $distinct = false): static;







    /**
     * @param string $columns
     * @return $this
    */
    public function addSelect(string $columns): static;





    /**
     * @param string $from
     * @param string $alias
     * @return $this
    */
    public function from(string $from, string $alias = ''): static;






    /**
     * @param string $classname
     *
     * @return $this
    */
    public function map(string $classname): static;






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
     * @param string $condition
     * @return $this
    */
    public function rightJoin(string $table, string $condition): static;










    /**
     * @param string $table
     * @param string $condition
     * @return $this
    */
    public function innerJoin(string $table, string $condition): static;










    /**
     * @param string $table
     * @param string $condition
     * @return $this
    */
    public function fullJoin(string $table, string $condition): static;









    /**
     * @param string $join
     * @return $this
    */
    public function addJoin(string $join): static;








    /**
     * @param string $columns
     * @return $this
    */
    public function groupBy(string $columns): static;








    /**
     * @param string $columns
     * @return $this
    */
    public function addGroupBy(string $columns): static;









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
     * @param int $limit
     * @return $this
    */
    public function limit(int $limit): static;






    /**
     * @param $offset
     * @return $this
    */
    public function offset($offset): static;







    /**
     * Insert query
     *
     * @param string $table
     * @return $this
    */
    public function insert(string $table): static;








    /**
     * Set insert many values
     *
     * @param array $values
     * @return $this
    */
    public function values(array $values): static;






    /**
     * Set insert value
     *
     * @param string $column
     * @param $value
     * @param int $index
     * @return $this
    */
    public function setValue(string $column, $value, int $index = 0): static;








    /**
     * Update query
     *
     * @param string $table
     * @param string $alias
     * @return $this
    */
    public function update(string $table, string $alias = ''): static;








    /**
     * Set attribute to update
     *
     * @param string $column
     * @param $value
     * @return $this
    */
    public function set(string $column, $value): static;








    /**
     * Delete a record
     *
     * @param string $table
     * @param string $alias
     * @return static
    */
    public function delete(string $table, string $alias = ''): static;









    /**
     * @param string $condition
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
     * Returns parameter value
     *
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
     * Returns query string
     *
     * @return string
    */
    public function getSQL(): string;






    /**
     * Returns query object
     *
     * @return QueryInterface
    */
    public function getQuery(): QueryInterface;
}
