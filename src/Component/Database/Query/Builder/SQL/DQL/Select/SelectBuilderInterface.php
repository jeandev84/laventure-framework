<?php

declare(strict_types=1);

namespace Laventure\Component\Database\Query\Builder\SQL\DQL\Select;

use Laventure\Component\Database\Query\Builder\SQL\Conditions\SQLBuilderHasConditionInterface;
use Laventure\Component\Database\Query\Builder\SQL\Conditions\Where\WhereInterface;
use Laventure\Component\Database\Query\Builder\SQL\SQLBuilderInterface;

/**
 * SelectWhereBuilderInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\Builder\SQL\DQL\PgsqlSelectBuilder
*/
interface SelectBuilderInterface extends SQLBuilderHasConditionInterface
{
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
     * @param $columns
     * @return $this
    */
    public function addSelect($columns): static;


    /**
     * Selected the table
     *
     * @param string $table
     * @param string|null $alias
     * @return $this
    */
    public function from(string $table, string $alias = null): static;








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






    //    /**
    //     * @param int $page
    //     * @return array
    //    */
    //    public function paginate(int $page): array;
}
