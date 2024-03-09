<?php

declare(strict_types=1);

namespace Laventure\Component\Database\ORM\Persistence\Query\Builder\SQL;

use Laventure\Component\Database\ORM\Persistence\Manager\Contract\EntityManagerInterface;
use Laventure\Component\Database\Query\Builder\SQL\Conditions\SQLBuilderHasConditionInterface;

/**
 * BuilderHasConditions
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\ORM\Persistence\Query\Builder\SQL
*/
abstract class BuilderHasConditions extends Builder
{
    /**
     * @var SQLBuilderHasConditionInterface
    */
    protected $builder;




    /**
     * @param EntityManagerInterface $em
     * @param SQLBuilderHasConditionInterface $builder
    */
    public function __construct(
        EntityManagerInterface $em,
        SQLBuilderHasConditionInterface $builder
    ) {
        parent::__construct($em, $builder);
    }




    /**
     * @param array $conditions
     * @return $this
    */
    public function criteria(array $conditions): static
    {
        $this->builder->criteria($conditions);

        return $this;
    }





    /**
     * @param $condition
     * @return $this
    */
    public function where($condition): static
    {
        $this->builder->where($condition);

        return $this;
    }





    /**
     * @param $column
     * @param array $value
     * @return $this
    */
    public function whereIn($column, array $value): static
    {
        $this->builder->whereIn($column, $value);

        return $this;
    }






    /**
     * @param $column
     * @param $value
     * @return $this
    */
    public function whereEqualTo($column, $value): static
    {
        $this->builder->whereEqualTo($column, $value);

        return $this;
    }




    /**
     * @param $condition
     * @return $this
    */
    public function andWhere($condition): static
    {
        $this->builder->andWhere($condition);

        return $this;
    }




    /**
     * @param $condition
     * @return $this
    */
    public function orWhere($condition): static
    {
        $this->builder->orWhere($condition);

        return $this;
    }





    /**
     * @param $condition
     * @param $type
     * @return $this
    */
    public function addWhere($condition, $type = null): static
    {
        $this->builder->addWhere($condition, $type);

        return $this;
    }





    /**
     * @return array
    */
    public function getWheres(): array
    {
        return $this->builder->getWheres();
    }
}
