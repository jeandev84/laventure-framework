<?php
declare(strict_types=1);

namespace Laventure\Component\Database\Query\Builder;

use Laventure\Component\Database\Builder\SQL\Conditions\Contract\HasConditionInterface;
use Laventure\Component\Database\Builder\SQL\DQL\Select\SelectBuilderInterface;
use Laventure\Component\Database\Builder\SQL\ExpressionInterface;


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
     * select columns
     *
     * @param string|null $columns
     * @return $this
    */
    public function select(string $columns = null): static;




    /**
     * @param bool $distinct
     * @return $this
    */
    public function distinct(bool $distinct): static;




    /**
     * Add columns
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
     * @param string $column
     * @param string|null $direction
     * @return $this
    */
    public function orderBy(string $column, string $direction = null): static;






    /**
     * @param string $orderBy
     * @return $this
    */
    public function addOrderBy(string $orderBy): static;






    /**
     * Set max results
     *
     * @param $limit
     * @return $this
    */
    public function setMaxResult($limit): static;







    /**
     * Set min results
     *
     * @param $offset
     * @return $this
    */
    public function setFirstResult($offset): static;







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
     * @return ExpressionInterface
    */
    public function expr(): ExpressionInterface;
}