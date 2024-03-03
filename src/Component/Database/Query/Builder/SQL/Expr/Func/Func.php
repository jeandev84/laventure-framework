<?php

declare(strict_types=1);

namespace Laventure\Component\Database\Query\Builder\SQL\Expr\Func;

/**
 * Func
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\Builder\SQL\Expr
*/
class Func implements FuncInterface
{
    /**
     * @param string $expression
    */
    public function __construct(protected string $expression)
    {
    }


    /**
     * @return string
    */
    public function __toString(): string
    {
        return $this->expression;
    }




    /**
     * @inheritDoc
    */
    public function getExpression(): string
    {
        return $this->expression;
    }
}
