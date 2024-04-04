<?php

declare(strict_types=1);

namespace Laventure\Component\Database\Query\Builder\SQL\Expr\Func;

use Stringable;

/**
 * FuncInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\Builder\SQL\Expr\Func
 */
interface FuncInterface extends Stringable
{
    /**
     * @return string
    */
    public function getExpression(): string;
}
