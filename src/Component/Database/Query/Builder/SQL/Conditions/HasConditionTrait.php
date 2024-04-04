<?php

declare(strict_types=1);

namespace Laventure\Component\Database\Query\Builder\SQL\Conditions;

/**
 * HasConditionTrait
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package Laventure\Component\Database\Builder\SQL\Conditions\Traits
*/
trait HasConditionTrait
{
    /**
     * @var array
    */
    public array $conditions = [];



    /**
     * @param array $conditions
     * @return $this
    */
    public function withConditions(array $conditions): static
    {
        $this->conditions = array_merge($this->conditions, $conditions);

        return $this;
    }



    /**
     * @return array
    */
    public function getConditions(): array
    {
        return $this->conditions;
    }
}
