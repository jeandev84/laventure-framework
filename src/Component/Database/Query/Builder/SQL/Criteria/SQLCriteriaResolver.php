<?php
declare(strict_types=1);

namespace Laventure\Component\Database\Query\Builder\SQL\Criteria;

use Laventure\Component\Database\Query\Builder\SQL\SQLBuilder;
use Laventure\Component\Database\Query\Builder\SQL\SQLBuilderInterface;

/**
 * SQLCriteriaResolver
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\Query\Builder\SQL\Criteria
*/
class SQLCriteriaResolver implements SQLCriteriaResolverInterface
{


    /**
     * @var SQLBuilder
    */
    protected SQLBuilder $builder;




    /**
     * @inheritDoc
    */
    public function withBuilder(SQLBuilder $builder): static
    {
        $this->builder = $builder;

        return $this;
    }





    /**
     * @inheritDoc
    */
    public function resolveWhereIn($column, array $value): SQLBuilderInterface
    {
        return $this->builder->whereIn($column, $value);
    }






    /**
     * @inheritDoc
    */
    public function resolveWhereEqualTo($column, $value): SQLBuilderInterface
    {
        return $this->builder->andWhere("$column = $value");
    }
}