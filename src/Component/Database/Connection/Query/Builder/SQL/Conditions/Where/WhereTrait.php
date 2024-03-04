<?php
declare(strict_types=1);

namespace Laventure\Component\Database\Connection\Query\Builder\SQL\Conditions\Where;

use Laventure\Component\Database\Connection\Query\Builder\SQL\Conditions\ConditionType;


/**
 * WhereBuilderTrait
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\Query\Builder\SQL\Traits
*/
trait WhereTrait
{
    /**
     * @var array
    */
    public array $wheres = [];




    /**
     * @param $condition
     * @return $this
    */
    public function where($condition): static
    {
        return $this->addWhere($condition);
    }




    /**
     * @inheritDoc
    */
    public function andWhere($condition): static
    {
        return $this->addWhere($condition, ConditionType::AND);
    }




    /**
     * @inheritDoc
    */
    public function orWhere($condition): static
    {
        return $this->addWhere($condition, ConditionType::OR);
    }





    /**
     * @inheritDoc
    */
    public function addWhere($condition, $type = null): static
    {
        $this->wheres[$type ?: ConditionType::DEFAULT][] = $condition;

        return $this;
    }








    /**
     * @inheritdoc
    */
    public function whereIn($column, array $value): static
    {
        return $this->andWhere("$column IN (". join(', ', $value) . ")");
    }


    
    



    /**
     * @inheritdoc
    */
    public function criteria(array $conditions): static
    {
        foreach ($conditions as $column => $value) {
            if (is_array($value)) {
                $this->whereIn($column, $value);
            } else {
                $this->andWhere("$column = $value");
            }
        }

        return $this;
    }






    /**
     * @return array
    */
    public function getWheres(): array
    {
        return $this->wheres;
    }
}
