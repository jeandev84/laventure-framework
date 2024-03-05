<?php

declare(strict_types=1);

namespace Laventure\Component\Database\Query\Builder\SQL\Expr\Math;

use Stringable;

/**
 * MathInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\Builder\SQL\Expr\Math
*/
interface MathInterface extends Stringable
{
    /**
     * @return string
    */
    public function getFirstOperand(): string;


    /**
     * @return string
    */
    public function getOperator(): string;



    /**
     * @return string
     */
    public function getSecondOperand(): string;
}
