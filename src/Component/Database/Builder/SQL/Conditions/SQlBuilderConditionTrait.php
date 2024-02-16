<?php

declare(strict_types=1);

namespace Laventure\Component\Database\Builder\SQL\Conditions;

use Laventure\Component\Database\Builder\SQL\SQlBuilderTrait;
use Laventure\Component\Database\Builder\SQL\Expr\Where;

/**
 * SQlBuilderConditionTrait
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\Builder\SQL\Conditions
 */
trait SQlBuilderConditionTrait
{
    use SQlBuilderTrait;

    /**
     * @param string $condition
     * @return $this
    */
    public function where(string $condition): static
    {
        $this->criteria->wheres[] = $condition;

        return $this;
    }



    /**
     * @return array
    */
    public function getConditions(): array
    {
        return $this->criteria->wheres;
    }
}
