<?php
declare(strict_types=1);

namespace Laventure\Component\Database\Query\Builder\SQL\DQL\Select;


use Laventure\Component\Database\Query\Builder\SQL\Decorator\SQLBuilderDecorator;
use Laventure\Component\Database\Query\Builder\SQL\Decorator\SQLBuilderDecoratorTrait;
use Laventure\Component\Database\Query\Builder\SQL\SQLBuilder;

/**
 * SelectBuilderDecorator
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\Query\Builder\SQL\DQL\Select
*/
class SelectBuilderDecorator extends SQLBuilderDecorator implements SelectBuilderInterface
{

    /**
     * @var SelectBuilderInterface
    */
    protected $builder;



    /**
     * @param SelectBuilderInterface $builder
    */
    public function __construct(SelectBuilderInterface $builder)
    {
        parent::__construct($builder);
    }




    /**
     * @inheritDoc
    */
    public function distinct(): static
    {
        $this->builder->distinct();

        return $this;
    }




    /**
     * @inheritDoc
    */
    public function select(string $columns): static
    {
        $this->builder->select($columns);

        return $this;
    }




    /**
     * @inheritDoc
    */
    public function addSelect(string $columns): static
    {
        $this->builder->addSelect($columns);

        return $this;
    }




    /**
     * @inheritDoc
    */
    public function from(string $table, string $alias = ''): static
    {
        $this->builder->from($table, $alias);

        return $this;
    }




    /**
     * @inheritDoc
    */
    public function join(string $table, string $condition): static
    {
        $this->builder->join($table, $condition);

        return $this;
    }




    /**
     * @inheritDoc
    */
    public function leftJoin(string $table, string $condition): static
    {
        $this->builder->leftJoin($table, $condition);

        return $this;
    }




    /**
     * @inheritDoc
    */
    public function rightJoin(string $table, string $condition): static
    {
        $this->builder->rightJoin($table, $condition);

        return $this;
    }




    /**
     * @inheritDoc
    */
    public function innerJoin(string $table, string $condition): static
    {
        $this->builder->innerJoin($table, $condition);

        return $this;
    }




    /**
     * @inheritDoc
    */
    public function fullJoin(string $table, string $condition): static
    {
        $this->builder->fullJoin($table, $condition);

        return $this;
    }




    /**
     * @inheritDoc
    */
    public function addJoin(string $join): static
    {
        $this->builder->addJoin($join);

        return $this;
    }




    /**
     * @inheritDoc
    */
    public function groupBy(string $columns): static
    {
        $this->builder->groupBy($columns);

        return $this;
    }




    /**
     * @inheritDoc
    */
    public function addGroupBy(string $columns): static
    {
        $this->builder->addGroupBy($columns);

        return $this;
    }



    /**
     * @inheritDoc
    */
    public function addHaving(string $condition, $type = null): static
    {
        $this->builder->addHaving($condition, $type);

        return $this;
    }




    /**
     * @inheritDoc
    */
    public function having(string $condition): static
    {
        $this->builder->having($condition);

        return $this;
    }



    /**
     * @inheritDoc
    */
    public function andHaving(string $condition): static
    {
        $this->builder->addHaving($condition);

        return $this;
    }




    /**
     * @inheritDoc
    */
    public function orHaving(string $condition): static
    {
        $this->builder->orHaving($condition);

        return $this;
    }




    /**
     * @inheritDoc
    */
    public function orderBy(string $column, string $direction = null): static
    {
        $this->builder->orderBy($column, $direction);

        return $this;
    }




    /**
     * @inheritDoc
    */
    public function addOrderBy(array $orders): static
    {
        $this->builder->addOrderBy($orders);

        return $this;
    }





    /**
     * @inheritDoc
    */
    public function limit($limit): static
    {
        $this->builder->limit($limit);

        return $this;
    }




    /**
     * @inheritDoc
    */
    public function offset($offset): static
    {
        $this->builder->offset($offset);

        return $this;
    }
}