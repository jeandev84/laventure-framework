<?php

declare(strict_types=1);

namespace Laventure\Component\Database\Query\Builder\SQL\Expr\Comparison;

use Stringable;

/**
 * ComparisonInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\Builder\SQL\Expr\Comparison
 */
interface ComparisonInterface extends Stringable
{
    /**
     * @return string
    */
    public function getColumn(): string;


    /**
     * @return string
    */
    public function getOperator(): string;



    /**
     * @return mixed
    */
    public function getValue(): mixed;
}
