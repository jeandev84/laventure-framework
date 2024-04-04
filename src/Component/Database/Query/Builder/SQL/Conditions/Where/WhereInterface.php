<?php

declare(strict_types=1);

namespace Laventure\Component\Database\Query\Builder\SQL\Conditions\Where;

use Laventure\Component\Database\Query\Builder\SQL\Conditions\Criteria\HasCriteriaInterface;
use Laventure\Component\Database\Query\Builder\SQL\Conditions\Criteria\Resolver\SQLCriteriaResolverInterface;

/**
 * WhereBuilderInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\Builder\SQL\Conditions\Contract
*/
interface WhereInterface
{
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
     * @param $condition
     * @param $type
     * @return $this
    */
    public function addWhere($condition, $type = null): static;







    /**
     * Returns conditions
     *
     * @return array
    */
    public function getWheres(): array;
}
