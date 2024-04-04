<?php

declare(strict_types=1);

namespace Laventure\Component\Database\Query\Builder\SQL\Expr\Math;

/**
 * Math
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\Builder\SQL\Expr
*/
class Math implements MathInterface
{
    /**
     * @param string $x
     *
     * @param string $operator
     *
     * @param string $y
    */
    public function __construct(
        protected string $x,
        protected string $operator,
        protected string $y
    ) {
    }




    /**
     * @inheritDoc
    */
    public function __toString(): string
    {
        return sprintf('%s %s %s', $this->x, $this->operator, $this->y);
    }



    /**
     * @inheritDoc
    */
    public function getFirstOperand(): string
    {
        return $this->x;
    }



    /**
     * @inheritDoc
    */
    public function getOperator(): string
    {
        return $this->operator;
    }




    /**
     * @inheritDoc
    */
    public function getSecondOperand(): string
    {
        return $this->y;
    }
}
