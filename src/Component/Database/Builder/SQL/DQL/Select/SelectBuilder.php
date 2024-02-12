<?php
declare(strict_types=1);

namespace Laventure\Component\Database\Builder\SQL\DQL\Select;


use Laventure\Component\Database\Builder\SQL\Builder;
use Laventure\Component\Database\Builder\SQL\Expr\From;
use Laventure\Component\Database\Builder\SQL\Expr\GroupBy;
use Laventure\Component\Database\Builder\SQL\Expr\Having;
use Laventure\Component\Database\Builder\SQL\Expr\Join;
use Laventure\Component\Database\Builder\SQL\Expr\Limit;
use Laventure\Component\Database\Builder\SQL\Expr\Select;
use Laventure\Component\Database\Builder\SQL\Expr\Where;


/**
 * SelectBuilder
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\Builder\SQL\DQL\Select
*/
class SelectBuilder extends Builder implements SelectBuilderInterface
{

    /**
     * @inheritdoc
    */
    public function select(string ...$columns): static
    {
        return $this->addSelect(...$columns);
    }




    /**
     * @inheritdoc
    */
    public function addSelect(string ...$columns): static
    {
        $this->criteria->selects = array_merge(
            $this->criteria->selects,
            $columns
        );

        return $this;
    }





    /**
     * @inheritdoc
    */
    public function from(string $from, string $alias = ''): static
    {
        $this->criteria->from[$from] = ($alias ? "$from $alias": $from);

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
        $this->criteria->joins[] = $join;

        return $this;
    }




    /**
     * @inheritdoc
    */
    public function groupBy(string ...$columns): static
    {
        return $this->addGroupBy(...$columns);
    }




    /**
     * @inheritdoc
    */
    public function addGroupBy(string ...$columns): static
    {
        $this->criteria->groupBy = array_merge(
            $this->criteria->groupBy,
            $columns
        );

        return $this;
    }





    /**
     * @inheritdoc
    */
    public function having(string $condition): static
    {
        $this->criteria->having[] = $condition;

        return $this;
    }




    /**
     * @inheritDoc
    */
    public function andHaving(string $condition): static
    {
        return $this;
    }




    /**
     * @inheritDoc
    */
    public function orHaving(string $condition): static
    {
        return $this;
    }





    /**
     * @inheritdoc
    */
    public function orderBy(string $column, string $direction = null): static
    {
        return $this->addOrderBy("$column ". $direction ?: 'ASC');
    }






    /**
     * @inheritdoc
    */
    public function addOrderBy(string ...$orders): static
    {
        $this->criteria->orderBy = array_merge(
            $this->criteria->orderBy,
            $orders
        );

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
    public function getSQL(): string
    {
        return $this->formatter->addFormats([
            new Select($this->criteria->selects),
            new From($this->criteria->from),
            new Join($this->criteria->joins),
            new Where($this->criteria->wheres),
            new GroupBy($this->criteria->groupBy),
            new Having($this->criteria->having),
            new Limit($this->criteria->limit, $this->criteria->offset)
        ])->format();
    }
}