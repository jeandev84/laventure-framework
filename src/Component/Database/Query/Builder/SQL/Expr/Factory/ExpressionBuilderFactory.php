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
 * @package  Laventure\Component\Database\Query\Builder\SQL\Expr
*/
class ExpressionBuilderFactory
{
       /**
        * @return ExpressionBuilderInterface
       */
       public function createExpressionBuilder(): ExpressionBuilderInterface
       {
           return new Expr();
       }
}