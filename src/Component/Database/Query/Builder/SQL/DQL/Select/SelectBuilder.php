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
use Laventure\Component\Database\Query\Builder\SQL\Conditions\Where\WhereTrait;
use Laventure\Component\Database\Query\Builder\SQL\SQLBuilder;

/**
 * SelectBuilder
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\Builder\SQL\DQL\Select
*/
class SelectBuilder extends SQLBuilder implements SelectBuilderInterface
{
    use WhereTrait;


    /**
     * @var string
    */
    public string $prefix = '';



    /**
     * @var string[]
    */
    public array $selects = [];


    /**
     * @var string[]
    */
    public array $from = [];



    /**
     * @var string[]
    */
    public array $joins = [];



    /**
     * @var string[]
    */
    public array $groupBy = [];




    /**
     * @var string[]
    */
    public array $having = [];


    


    /**
     * @var string[]
    */
    public array $orderBy = [];






    /**
     * @var null
    */
    public $offset = null;




    /**
     * @var null
    */
    public $limit = null;





    /**
     * @inheritdoc
    */
    public function select(string $columns): static
    {
        return $this->addSelect($columns);
    }




    /**
     * @inheritdoc
    */
    public function distinct(): static
    {
        $this->prefix = "DISTINCT";

        return $this;
    }




    /**
     * @inheritdoc
    */
    public function addSelect(string $columns): static
    {
        $this->selects[] = $columns;

        return $this;
    }





    /**
     * @inheritdoc
    */
    public function from(string $table, string $alias = ''): static
    {
        $this->from[$alias ?: $table] = ($alias ? "$table $alias" : $table);

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
        $this->joins[] = $join;

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
        $this->groupBy[] = $columns;

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
        $this->having[$type ?: ConditionType::DEFAULT][] = $condition;

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
            $this->orderBy[$column]  = sprintf(
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
        $this->limit = $limit;

        return $this;
    }





    /**
     * @inheritdoc
    */
    public function offset($offset): static
    {
        $this->offset = $offset;

        return $this;
    }






    /**
     * @inheritDoc
    */
    protected function getCommands(): array
    {
        return [
            new Select($this->selects, $this->prefix),
            new From($this->from),
            new Joins($this->joins),
            new Where($this->wheres),
            new GroupBy($this->groupBy),
            new Having($this->having),
            new OrderBy($this->orderBy),
            new Limit($this->limit, $this->offset)
        ];
    }
}
