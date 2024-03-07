<?php

declare(strict_types=1);

namespace Laventure\Component\Database\Query\Builder\SQL\Expr\Factory;

use Laventure\Component\Database\Query\Builder\SQL\Expr\ExpressionBuilderInterface;

/**
 * ExpressionBuilderFactoryInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\Query\Builder\SQL\Expr
*/
interface ExpressionBuilderFactoryInterface
{
    /**
     * @return ExpressionBuilderInterface
    */
    public function createExpressionBuilder(): ExpressionBuilderInterface;
}
