<?php

declare(strict_types=1);

namespace Laventure\Component\Database\Query\Builder\SQL\Expr;

use Laventure\Component\Database\Query\Builder\SQL\Expr\Comparison\Comparison;
use Laventure\Component\Database\Query\Builder\SQL\Expr\Comparison\ComparisonInterface;
use Laventure\Component\Database\Query\Builder\SQL\Expr\Conditions\andX;
use Laventure\Component\Database\Query\Builder\SQL\Expr\Conditions\Contract\andXInterface;
use Laventure\Component\Database\Query\Builder\SQL\Expr\Conditions\Contract\orXInterface;
use Laventure\Component\Database\Query\Builder\SQL\Expr\Conditions\orX;
use Laventure\Component\Database\Query\Builder\SQL\Expr\Func\Func;
use Laventure\Component\Database\Query\Builder\SQL\Expr\Func\FuncInterface;
use Laventure\Component\Database\Query\Builder\SQL\Expr\Math\Math;
use Laventure\Component\Database\Query\Builder\SQL\Expr\Math\MathInterface;

/**
 * Expr
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\Builder\SQL\Exp
*/
class Expr implements ExpressionBuilderInterface
{
    /**
     * @inheritDoc
    */
    public function andX(...$conditions): andXInterface
    {
        return new andX($conditions);
    }




    /**
     * @inheritDoc
    */
    public function orX(...$conditions): orXInterface
    {
        return new orX($conditions);
    }




    /**
     * @inheritDoc
    */
    public function eq(string $column, $value): ComparisonInterface
    {
        return new Comparison($column, "=", $value);
    }





    /**
     * @inheritdoc
    */
    public function distinct($expression): string
    {
        return "DISTINCT $expression";
    }





    /**
     * @inheritDoc
    */
    public function isNull(string $column): string
    {
        return "$column IS NULL";
    }




    /**
     * @inheritDoc
    */
    public function isNotNull(string $column): string
    {
        return "$column IS NOT NULL";
    }




    /**
     * @inheritDoc
    */
    public function isMemberOf(string $instance, string $column): ComparisonInterface
    {
        return new Comparison($instance, "MEMBER OF", $column);
    }




    /**
     * @inheritDoc
    */
    public function isInstanceOf(string $column, string $class): ComparisonInterface
    {
        return new Comparison($column, "INSTANCE OF", $class);
    }





    /**
     * @inheritDoc
    */
    public function sum(string $x, string $y): MathInterface
    {
        return new Math($x, "+", $y);
    }






    /**
     * @inheritDoc
    */
    public function prod(string $x, string $y): MathInterface
    {
        return new Math($x, "*", $y);
    }







    /**
     * @inheritDoc
    */
    public function diff(string $x, string $y): MathInterface
    {
        return new Math($x, "-", $y);
    }





    /**
     * @inheritDoc
    */
    public function quot(string $x, string $y): MathInterface
    {
        return new Math($x, "/", $y);
    }






    /**
     * @inheritDoc
    */
    public function in(string $column, $value): FuncInterface
    {
        if (is_array($value)) {
            $value = join(', ', $value);
        }

        return new Func("$column IN ($value)");
    }





    /**
     * @inheritDoc
    */
    public function not(string $condition): FuncInterface
    {
        return new Func("NOT $condition");
    }





    /**
     * @inheritDoc
    */
    public function notIn(string $column, array|string $value): FuncInterface
    {
        return $this->not(strval($this->in($column, $value)));
    }





    /**
     * @inheritDoc
    */
    public function like(string $column, string $value): FuncInterface
    {
        return new Func("$column LIKE $value");
    }





    /**
     * @inheritDoc
    */
    public function notLike(string $column, string $value): FuncInterface
    {
        return $this->not(strval($this->like($column, $value)));
    }






    /**
     * @inheritDoc
    */
    public function between(string $column, mixed $start, mixed $end): FuncInterface
    {
        return new Func("$column BETWEEN $start AND $end");
    }






    /**
     * @inheritDoc
    */
    public function min(string $column): FuncInterface
    {
        return new Func("MIN($column)");
    }







    /**
     * @inheritDoc
    */
    public function max(string $column): FuncInterface
    {
        return new Func("MAX($column)");
    }





    /**
     * @inheritDoc
    */
    public function count(string $column): FuncInterface
    {
        return new Func("COUNT($column)");
    }




    /**
     * @inheritDoc
    */
    public function countDistinct(string $column): FuncInterface
    {
        return $this->count($this->distinct($column));
    }





    /**
     * @inheritDoc
    */
    public function avg(string $column): FuncInterface
    {
        return new Func("AVG($column)");
    }





    /**
     * @inheritDoc
    */
    public function abs(string $column): FuncInterface
    {
        return new Func("ABS($column)");
    }





    /**
     * @inheritDoc
    */
    public function sqrt(string $column): FuncInterface
    {
        return new Func("SQRT($column)");
    }




    /**
     * @inheritDoc
    */
    public function mod($value): FuncInterface
    {
        return new Func("MOD($value)");
    }





    /**
     * @inheritDoc
    */
    public function length(string $column): FuncInterface
    {
        return new Func("LEN($column)");
    }





    /**
     * @inheritDoc
    */
    public function upper(string $column): FuncInterface
    {
        return new Func("UPPER($column)");
    }





    /**
     * @inheritDoc
    */
    public function lower(string $column): FuncInterface
    {
        return new Func("Lower($column)");
    }





    /**
     * @inheritDoc
    */
    public function substring(string $column, $from, $len): FuncInterface
    {
        return new Func("SUBSTRING($column, $from, $len)");
    }






    /**
     * @inheritDoc
    */
    public function concat(string $column): FuncInterface
    {
        return new Func("CONCAT($column)");
    }






    /**
     * @inheritDoc
    */
    public function trim($value): FuncInterface
    {
        return new Func("TRIM($value)");
    }





    /**
     * @inheritDoc
    */
    public function exists(string $subQuery): FuncInterface
    {
        return new Func("EXIST $subQuery");
    }
}
