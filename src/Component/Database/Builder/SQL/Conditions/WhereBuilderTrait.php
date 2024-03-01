<?php

declare(strict_types=1);

namespace Laventure\Component\Database\Builder\SQL\Conditions;

/**
 * WhereBuilderTrait
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\Builder\SQL\Conditions
*/
trait WhereBuilderTrait
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
        $this->wheres[] = $condition;

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
