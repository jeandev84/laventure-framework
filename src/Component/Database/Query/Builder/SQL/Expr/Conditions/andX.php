<?php

declare(strict_types=1);

namespace Laventure\Component\Database\Query\Builder\SQL\Expr\Conditions;

use Laventure\Component\Database\Query\Builder\SQL\Conditions\HasConditionTrait;
use Laventure\Component\Database\Query\Builder\SQL\Expr\Conditions\Contract\andXInterface;

/**
 * andX
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\Builder\SQL\Expr
*/
class andX implements andXInterface
{
    use HasConditionTrait;


    /**
     * @param array $conditions
    */
    public function __construct(array $conditions = [])
    {
        $this->withConditions($conditions);
    }





    /**
     * @inheritdoc
    */
    public function __toString(): string
    {
        return join(" AND ", $this->conditions);
    }
}
