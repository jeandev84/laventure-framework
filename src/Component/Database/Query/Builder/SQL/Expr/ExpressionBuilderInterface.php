<?php

declare(strict_types=1);

namespace Laventure\Component\Database\Query\Builder\SQL\Expr;

use Laventure\Component\Database\Query\Builder\SQL\Expr\Comparison\ComparisonInterface;
use Laventure\Component\Database\Query\Builder\SQL\Expr\Conditions\Contract\andXInterface;
use Laventure\Component\Database\Query\Builder\SQL\Expr\Conditions\Contract\orXInterface;
use Laventure\Component\Database\Query\Builder\SQL\Expr\Func\FuncInterface;
use Laventure\Component\Database\Query\Builder\SQL\Expr\Math\MathInterface;

/**
 * ExpressionBuilderInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\Builder\SQL\Expr
*/
interface ExpressionBuilderInterface
{
    /**
     * Example: $condition1 AND $condition2 AND $condition3 ...
     *
     * @param ...$conditions
     *
     * @return andXInterface
    */
    public function andX(...$conditions): andXInterface;



    /**
     *  Example: $condition1 OR $condition2 OR $condition3 ...
     *
     * @param ...$conditions
     *
     * @return orXInterface
    */
    public function orX(...$conditions): orXInterface;





    /**
     * Example: $column = $value
     *
     * @param string $column
     *
     * @param $value
     *
     * @return ComparisonInterface
    */
    public function eq(string $column, $value): ComparisonInterface;






    /**
     * DISTINCT $expression
     *
     * @param $expression
     * @return string
    */
    public function distinct($expression): string;




    /**
     * Example: $column IS NULL
     *
     * @param string $column
     *
     * @return string
    */
    public function isNull(string $column): string;




    /**
     * Example: $column IS NOT NULL
     *
     * @param string $column
     *
     * @return string
    */
    public function isNotNull(string $column): string;





    /**
     * Example: $instance "MEMBER OF" $column
     *
     * @param string $column
     *
     * @param string $instance
     *
     * @return ComparisonInterface
    */
    public function isMemberOf(string $instance, string $column): ComparisonInterface;






    /**
     * Example: $column "INSTANCE OF" $class
     *
     * @param string $column
     * @param string $class
     * @return ComparisonInterface
    */
    public function isInstanceOf(string $column, string $class): ComparisonInterface;







    /**
     * Addition expression ($x + $y)
     *
     * @param string $x
     *
     * @param string $y
     *
     * @return MathInterface
    */
    public function sum(string $x, string $y): MathInterface;






    /**
     * Multiply expression ($x * $y)
     *
     * @param string $x
     *
     * @param string $y
     *
     * @return MathInterface
    */
    public function prod(string $x, string $y): MathInterface;






    /**
     * Subtract expression ($x - $y)
     *
     * @param string $x
     *
     * @param string $y
     *
     * @return MathInterface
    */
    public function diff(string $x, string $y): MathInterface;





    /**
     * Division expression ($x / $y)
     *
     *
     * @param string $x
     *
     * @param string $y
     *
     * @return MathInterface
    */
    public function quot(string $x, string $y): MathInterface;





    /**
     * Example: $column IN $value
     *
     * @param string $column
     *
     * @param $value
     *
     * @return FuncInterface
    */
    public function in(string $column, $value): FuncInterface;




    /**
     * Example: NOT $condition
     *
     * @param string $condition
     * @return FuncInterface
    */
    public function not(string $condition): FuncInterface;




    /**
     * Example: $column NOT IN $value
     *
     * @param string $column
     * @param string|array $value
     * @return FuncInterface
    */
    public function notIn(string $column, string|array $value): FuncInterface;





    /**
     * Example: $column LIKE $value
     *
     * @param string $column
     * @param string $value
     * @return FuncInterface
    */
    public function like(string $column, string $value): FuncInterface;





    /**
     * Example: $column NOT LIKE $value
     *
     * @param string $column
     * @param string $value
     * @return FuncInterface
    */
    public function notLike(string $column, string $value): FuncInterface;






    /**
     * Example : "$column BETWEEN $start AND $end"
     *
     * @param string $column
     * @param mixed $start
     * @param mixed $end
     * @return FuncInterface
    */
    public function between(string $column, mixed $start, mixed $end): FuncInterface;







    /**
     * Example: MIN($column)
     *
     * @param string $column
     *
     * @return FuncInterface
    */
    public function min(string $column): FuncInterface;







    /**
     * Example: MAX($column)
     *
     * @param string $column
     * @return FuncInterface
    */
    public function max(string $column): FuncInterface;





    /**
     * Example: COUNT($column)
     *
     * @param string $column
     * @return FuncInterface
    */
    public function count(string $column): FuncInterface;





    /**
     * Example: AVG($column)
     *
     * @param string $column
     * @return FuncInterface
    */
    public function avg(string $column): FuncInterface;






    /**
     * Example: ABS($column)
     *
     * @param string $column
     * @return FuncInterface
    */
    public function abs(string $column): FuncInterface;






    /**
     * Example: ABS($column)
     *
     * @param string $column
     * @return FuncInterface
    */
    public function sqrt(string $column): FuncInterface;




    /**
     * Example: MOD($column)
     *
     * @param $value
     * @return FuncInterface
    */
    public function mod($value): FuncInterface;




    /**
     * Example: LEN($column)
     *
     * @param string $column
     * @return FuncInterface
    */
    public function length(string $column): FuncInterface;





    /**
     * Example: COUNT(DISTINCT $column)
     *
     * @param string $column
     * @return FuncInterface
    */
    public function countDistinct(string $column): FuncInterface;




    /**
     * Example: UPPER($column)
     *
     * @param string $column
     * @return FuncInterface
    */
    public function upper(string $column): FuncInterface;





    /**
     * Example: LOWER($column)
     *
     * @param string $column
     * @return FuncInterface
    */
    public function lower(string $column): FuncInterface;





    /**
     * Example: SUBSTRING($column)
     *
     * @param string $column
     * @param $from
     * @param $len
     * @return FuncInterface
    */
    public function substring(string $column, $from, $len): FuncInterface;





    /**
     * Example: CONCAT($column)
     *
     * @param string $column
     * @return FuncInterface
    */
    public function concat(string $column): FuncInterface;





    /**
     * Example: TRIM($column)
     *
     * @param $value
     * @return FuncInterface
    */
    public function trim($value): FuncInterface;





    /**
     * Example: EXIST $subQuery
     *
     * @param string $subQuery
     * @return FuncInterface
    */
    public function exists(string $subQuery): FuncInterface;
}
