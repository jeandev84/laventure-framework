<?php
declare(strict_types=1);

namespace Laventure\Component\Database\Builder\SQL\DQL\Select;


use Laventure\Component\Database\Builder\SQL\Conditions\SQlBuilderConditionTrait;
use Laventure\Component\Database\Builder\SQL\Expr\From;
use Laventure\Component\Database\Builder\SQL\Expr\GroupBy;
use Laventure\Component\Database\Builder\SQL\Expr\Having;
use Laventure\Component\Database\Builder\SQL\Expr\Join;
use Laventure\Component\Database\Builder\SQL\Expr\Limit;
use Laventure\Component\Database\Builder\SQL\Expr\OrderBy;
use Laventure\Component\Database\Builder\SQL\Expr\Select;
use Laventure\Component\Database\Builder\SQL\Expr\Where;
use Laventure\Component\Database\Builder\SQL\Formatter\SQlFormatter;
use Laventure\Component\Database\Query\Result\QueryResultInterface;

/**
 * SelectBuilder
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\Builder\SQL\DQL\Select
*/
class SelectBuilder implements SelectBuilderInterface
{
    use SQlBuilderConditionTrait;


    /**
     * @var bool
    */
    protected bool $distinct = false;



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
    public function distinct(bool $distinct): static
    {
        $this->distinct = $distinct;

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
        $this->from[$table] = ($alias ? "$table $alias" : $table);

        return $this;
    }





    /**
     * @inheritdoc
    */
    public function addFrom(string $from): static
    {
        return $this->from($from);
    }





    /**
     * @inheritdoc
    */
    public function join(string $table, string $condition): static
    {
        return $this->addJoin("JOIN $table ON $condition");
    }






    /**
     * @inheritdoc
    */
    public function leftJoin(string $table, string $condition): static
    {
        return $this->addJoin("LEFT JOIN $table ON $condition");
    }





    /**
     * @inheritdoc
    */
    public function rightJoin(string $table, string $condition): static
    {
        return $this->addJoin("RIGHT JOIN $table ON $condition");
    }




    /**
     * @inheritdoc
    */
    public function innerJoin(string $table, string $condition): static
    {
        return $this->addJoin("INNER JOIN $table ON $condition");
    }



    /**
     * @inheritdoc
    */
    public function fullJoin(string $table, string $condition): static
    {
        return $this->addJoin("FULL JOIN $table ON $condition");
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
        $this->having[] = $condition;

        return $this;
    }







    /**
     * @inheritdoc
    */
    public function orderBy(string $column, string $direction = null): static
    {
        return $this->addOrderBy([$column => $direction ?: 'ASC']);
    }






    /**
     * @inheritdoc
    */
    public function addOrderBy(array $orders): static
    {
        foreach ($orders as $column => $direction) {
            $this->orderBy[] = "$column $direction";
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
    public function getSQL(): string
    {
        return (new SQlFormatter())->addFormats([
            new Select($this->resolveSelects()),
            new From($this->from),
            new Join($this->joins),
            new Where($this->wheres),
            new GroupBy($this->groupBy),
            new Having($this->having),
            new OrderBy($this->orderBy),
            new Limit($this->limit, $this->offset)
        ])->format();
    }





    /**
     * @return string
    */
    private function resolveSelects(): string
    {
        $columns  =  join(', ', array_filter($this->selects));
        $columns  =  !empty($this->selects) ? $columns : "*";

        return $this->distinct ? "DISTINCT $columns" : $columns;
    }
}
