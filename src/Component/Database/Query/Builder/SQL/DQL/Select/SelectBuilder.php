<?php

declare(strict_types=1);

namespace Laventure\Component\Database\Query\Builder\SQL\DQL\Select;

use Laventure\Component\Database\Query\Builder\SQL\Commands\From;
use Laventure\Component\Database\Query\Builder\SQL\Commands\FullJoin;
use Laventure\Component\Database\Query\Builder\SQL\Commands\GroupBy;
use Laventure\Component\Database\Query\Builder\SQL\Commands\Having;
use Laventure\Component\Database\Query\Builder\SQL\Commands\InnerJoin;
use Laventure\Component\Database\Query\Builder\SQL\Commands\Join;
use Laventure\Component\Database\Query\Builder\SQL\Commands\LeftJoin;
use Laventure\Component\Database\Query\Builder\SQL\Commands\Limit;
use Laventure\Component\Database\Query\Builder\SQL\Commands\OrderBy;
use Laventure\Component\Database\Query\Builder\SQL\Commands\RightJoin;
use Laventure\Component\Database\Query\Builder\SQL\Commands\Select;
use Laventure\Component\Database\Query\Builder\SQL\Commands\Utils\Joins;
use Laventure\Component\Database\Query\Builder\SQL\Commands\Where;
use Laventure\Component\Database\Query\Builder\SQL\Conditions\ConditionType;
use Laventure\Component\Database\Query\Builder\SQL\SQLBuilder;

/**
 * SelectBuilder
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\Builder\SQL\DQL\PgsqlSelectBuilder
*/
class SelectBuilder extends SQLBuilder implements SelectBuilderInterface
{
    /**
     * @var string
    */
    public string $suffix = '';




    /**
     * @inheritdoc
     */
    public function select($columns = null): static
    {
        return $this->addSelect($columns);
    }




    /**
     * @inheritdoc
     */
    public function distinct(): static
    {
        return $this->addSelectSuffix("DISTINCT");
    }





    /**
     * @inheritdoc
     */
    public function addSelect($columns): static
    {
        $this->criteria->columns[] = $columns;

        return $this;
    }





    /**
     * @inheritdoc
     */
    public function from(string $table, string $alias = null): static
    {
        if ($alias) {
            $this->criteria->alias[$alias] = $table;
            $this->criteria->from[$alias]  = "$table $alias";
        } else {
            $this->criteria->from[$table] = $table;
        }

        return $this;
    }





    /**
     * @inheritdoc
     */
    public function join(string $table, string $condition): static
    {
        return $this->addJoinExpr(new Join($table, $condition));
    }






    /**
     * @inheritdoc
     */
    public function leftJoin(string $table, string $condition): static
    {
        return $this->addJoinExpr(new LeftJoin($table, $condition));
    }





    /**
     * @inheritdoc
     */
    public function rightJoin(string $table, string $condition): static
    {
        return $this->addJoinExpr(new RightJoin($table, $condition));
    }




    /**
     * @inheritdoc
     */
    public function innerJoin(string $table, string $condition): static
    {
        return $this->addJoinExpr(new InnerJoin($table, $condition));
    }




    /**
     * @inheritdoc
     */
    public function fullJoin(string $table, string $condition): static
    {
        return $this->addJoinExpr(new FullJoin($table, $condition));
    }




    /**
     * @inheritdoc
     */
    public function addJoin(string $join): static
    {
        $this->criteria->joins[] = $join;

        return $this;
    }





    /**
     * @param Join $join
     * @return $this
    */
    public function addJoinExpr(Join $join): static
    {
        return $this->addJoin(strval($join));
    }






    /**
     * @inheritdoc
     */
    public function groupBy(string $columns): static
    {
        return $this->addGroupBy($columns);
    }




    /**
     * @inheritdoc
     */
    public function addGroupBy(string $columns): static
    {
        $this->criteria->groupBy[] = $columns;

        return $this;
    }





    /**
     * @inheritdoc
     */
    public function having(string $condition): static
    {
        return $this->addHaving($condition);
    }





    /**
     * @inheritDoc
     */
    public function andHaving(string $condition): static
    {
        return $this->addHaving($condition, ConditionType::AND);
    }







    /**
     * @inheritDoc
     */
    public function orHaving(string $condition): static
    {
        return $this->addHaving($condition, ConditionType::OR);
    }





    /**
     * @inheritDoc
    */
    public function addHaving(string $condition, $type = null): static
    {
        $this->criteria->having[$type ?: ConditionType::DEFAULT][] = $condition;

        return $this;
    }






    /**
     * @inheritdoc
     */
    public function orderBy(string $column, string $direction = null): static
    {
        return $this->addOrderBy([$column => $direction ?: 'asc']);
    }






    /**
     * @inheritdoc
    */
    public function addOrderBy(array $orders): static
    {
        foreach ($orders as $column => $direction) {
            $this->criteria->orderBy[$column]  = sprintf(
                '%s %s',
                $column,
                strtoupper($direction)
            );
        }

        return $this;
    }






    /**
     * @inheritdoc
    */
    public function limit($limit): static
    {
        $this->criteria->limit = $limit;

        return $this;
    }





    /**
     * @inheritdoc
     */
    public function offset($offset): static
    {
        $this->criteria->offset = $offset;

        return $this;
    }






    /**
     * @inheritDoc
    */
    protected function getCommands(): array
    {
        return [
            new Select($this->criteria->columns, $this->suffix),
            new From($this->criteria->from),
            new Joins($this->criteria->joins),
            new Where($this->criteria->wheres),
            new GroupBy($this->criteria->groupBy),
            new Having($this->criteria->having),
            new OrderBy($this->criteria->orderBy),
            new Limit($this->criteria->limit, $this->criteria->offset)
        ];
    }








    /**
     * @param string $suffix
     * @return $this
    */
    protected function addSelectSuffix(string $suffix): static
    {
        $this->suffix = $suffix;

        return $this;
    }
}
