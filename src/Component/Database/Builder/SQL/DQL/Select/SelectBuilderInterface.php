<?php

declare(strict_types=1);

namespace Laventure\Component\Database\Builder\SQL\DQL\Select;

use Laventure\Component\Database\Builder\SQL\Conditions\Contract\WhereInterface;
use Laventure\Component\Database\Builder\SQL\SQLBuilderInterface;

/**
 * SelectWhereBuilderInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\Builder\SQL\DQL\Select
*/
interface SelectBuilderInterface extends SQLBuilderInterface, WhereInterface
{
    /**
     * Select columns
     *
     * @param string $columns
     * @return $this
    */
    public function select(string $columns): static;






    /**
     * Select distinct values
     *
     * @param bool $distinct
     * @return $this
    */
    public function distinct(bool $distinct): static;





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
     * @param string $table
     * @param string $alias
     * @return $this
    */
    public function from(string $table, string $alias = ''): static;




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
}
