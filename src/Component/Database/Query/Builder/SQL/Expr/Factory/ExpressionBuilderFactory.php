<?php

declare(strict_types=1);

namespace Laventure\Component\Database\Query\Builder\SQL\Expr\Factory;

use Laventure\Component\Database\Query\Builder\SQL\Expr\Expr;
use Laventure\Component\Database\Query\Builder\SQL\Expr\ExpressionBuilderInterface;

/**
 * ExpressionBuilderFactory
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\Statement\Builder\SQL\Expr\Factory
 */
class ExpressionBuilderFactory implements ExpressionBuilderFactoryInterface
{
    /**
     * @inheritDoc
    */
    public function create(): ExpressionBuilderInterface
    {
        return new Expr();
    }
}
