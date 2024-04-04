<?php

declare(strict_types=1);

namespace Laventure\Component\Database\Query\Builder\SQL\Conditions\Criteria\Resolver;

use Laventure\Component\Database\Query\Builder\SQL\Conditions\Criteria\Resolved\CriteriaResolvedInterface;

/**
 * SQLCriteriaMapperInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\Statement\Builder\SQL\Criteria
*/
interface SQLCriteriaResolverInterface
{
    /**
     * @param $column
     * @param array $value
     * @return CriteriaResolvedInterface
    */
    public function resolveWhereIn($column, array $value): CriteriaResolvedInterface;







    /**
     * @param $column
     * @param $value
     * @return CriteriaResolvedInterface
    */
    public function resolveWhereEqualTo($column, $value): CriteriaResolvedInterface;
}
