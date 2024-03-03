<?php

declare(strict_types=1);

namespace Laventure\Component\Database\Query\Builder\SQL\Conditions;

/**
 * HasConditionInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\Builder\SQL\Conditions\Contract
*/
interface HasConditionInterface
{
    /**
     * @param array $conditions
     * @return $this
    */
    public function withConditions(array $conditions): static;




    /**
     * Returns conditions
     *
     * @return array
    */
    public function getConditions(): array;
}
