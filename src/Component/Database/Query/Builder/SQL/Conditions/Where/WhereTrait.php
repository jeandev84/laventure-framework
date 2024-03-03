<?php
declare(strict_types=1);

namespace Laventure\Component\Database\Query\Builder\SQL\Conditions\Where;

use Laventure\Component\Database\Query\Builder\SQL\Conditions\ConditionType;

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
     * @param string $condition
     * @return $this
    */
    public function where(string $condition): static
    {
        return $this->addWhere($condition);
    }




    /**
     * @inheritDoc
    */
    public function andWhere(string $condition): static
    {
        return $this->addWhere($condition, ConditionType::AND);
    }




    /**
     * @inheritDoc
    */
    public function orWhere(string $condition): static
    {
        return $this->addWhere($condition, ConditionType::OR);
    }





    /**
     * @inheritDoc
    */
    public function addWhere(string $condition, $type = null): static
    {
        $this->wheres[$type ?: ConditionType::DEFAULT][] = $condition;

        return $this;
    }


    
    



    /**
     * Add WHERE conditions BY criteria
     *
     * @param array $conditions
     * @return $this
    */
    public function criteria(array $conditions): static
    {
        foreach ($conditions as $column => $value) {
            if (is_array($value)) {
                $this->addCriteriaFromArrayValues($column, $value);
            } else {
                $this->addCriteria($column, $value);
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





    /**
     * @param string $column
     * @param $value
     * @return void
    */
    protected function addCriteria(string $column, $value): void
    {
        $this->andWhere("$column = $value");
    }






    /**
     * @param string $column
     * @param array $value
     * @return void
    */
    protected function addCriteriaFromArrayValues(string $column, array $value): void
    {
         $this->andWhere("$column IN (". join(', ', $value) . ")");
    }
}
