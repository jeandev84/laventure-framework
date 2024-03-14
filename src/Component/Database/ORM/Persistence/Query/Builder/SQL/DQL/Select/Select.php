<?php

declare(strict_types=1);

namespace Laventure\Component\Database\ORM\Persistence\Query\Builder\SQL\DQL\Select;

use Laventure\Component\Database\ORM\Persistence\Manager\Contract\EntityManagerInterface;
use Laventure\Component\Database\ORM\Persistence\Query\Builder\SQL\BuilderHasConditions;
use Laventure\Component\Database\ORM\Persistence\Query\Query;
use Laventure\Component\Database\ORM\Persistence\Query\QueryInterface;
use Laventure\Component\Database\Query\Builder\SQL\DQL\Select\SelectBuilderInterface;

/**
 * Select
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\ORM\Mapper\Query\Builder\SQL\DQL
*/
class Select extends BuilderHasConditions
{
    /**
     * @var string
    */
    protected string $mappedClass;



    /**
     * @var SelectBuilderInterface
    */
    protected $builder;





    /**
     * @param EntityManagerInterface $em
     * @param SelectBuilderInterface $builder
    */
    public function __construct(EntityManagerInterface $em, SelectBuilderInterface $builder)
    {
        parent::__construct($em, $builder);
    }




    /**
     * @param string $columns
     * @return $this
    */
    public function select(string $columns): static
    {
        $this->builder->select($columns);

        return $this;
    }



    /**
     * @return $this
    */
    public function distinct(): static
    {
        $this->builder->distinct();

        return $this;
    }





    /**
     * @param string $columns
     * @return $this
    */
    public function addSelect(string $columns): static
    {
        $this->builder->addSelect($columns);

        return $this;
    }




    /**
     * @param string $from
     * @param string $alias
     * @return $this
    */
    public function from(string $from, string $alias = ''): static
    {
        $this->builder->from($from, $alias);

        if ($this->hasMappedClass($from)) {
            $tableName = $this->getTableNameFromClass($from);
            $this->builder->from($tableName, $alias);
            $this->mappedClass = $from;
        }

        return $this;
    }






    /**
     * @param string $table
     * @param string $condition
     * @return $this
    */
    public function join(string $table, string $condition): static
    {
        $this->builder->join($table, $condition);

        return $this;
    }






    /**
     * @param string $table
     * @param string $condition
     * @return $this
    */
    public function leftJoin(string $table, string $condition): static
    {
        $this->builder->leftJoin($table, $condition);

        return $this;
    }






    /**
     * @param string $table
     * @param string $condition
     * @return $this
    */
    public function rightJoin(string $table, string $condition): static
    {
        $this->builder->rightJoin($table, $condition);

        return $this;
    }





    /**
     * @param string $table
     * @param string $condition
     * @return $this
    */
    public function innerJoin(string $table, string $condition): static
    {
        $this->builder->innerJoin($table, $condition);

        return $this;
    }






    /**
     * @param string $table
     * @param string $condition
     * @return $this
    */
    public function fullJoin(string $table, string $condition): static
    {
        $this->builder->fullJoin($table, $condition);

        return $this;
    }





    /**
     * @param string $join
     * @return $this
    */
    public function addJoin(string $join): static
    {
        $this->builder->addJoin($join);

        return $this;
    }





    /**
     * @param string $columns
     * @return $this
    */
    public function groupBy(string $columns): static
    {
        $this->builder->groupBy($columns);

        return $this;
    }






    /**
     * @param string $columns
     * @return $this
    */
    public function addGroupBy(string $columns): static
    {
        $this->builder->addGroupBy($columns);

        return $this;
    }






    /**
     * @param string $condition
     * @param $type
     * @return $this
    */
    public function addHaving(string $condition, $type = null): static
    {
        $this->builder->addHaving($condition, $type);

        return $this;
    }






    /**
     * @param string $condition
     * @return $this
    */
    public function having(string $condition): static
    {
        $this->builder->having($condition);

        return $this;
    }





    /**
     * @param string $condition
     * @return $this
    */
    public function andHaving(string $condition): static
    {
        $this->builder->addHaving($condition);

        return $this;
    }






    /**
     * @param string $condition
     * @return $this
    */
    public function orHaving(string $condition): static
    {
        $this->builder->orHaving($condition);

        return $this;
    }





    /**
     * @param string $column
     * @param string|null $direction
     * @return $this
    */
    public function orderBy(string $column, string $direction = null): static
    {
        $this->builder->orderBy($column, $direction);

        return $this;
    }





    /**
     * @param array $orders
     * @return $this
    */
    public function addOrderBy(array $orders): static
    {
        $this->builder->addOrderBy($orders);

        return $this;
    }





    /**
     * @param $limit
     * @return $this
    */
    public function limit($limit): static
    {
        $this->builder->limit($limit);

        return $this;
    }





    /**
     * @param $offset
     * @return $this
    */
    public function offset($offset): static
    {
        $this->builder->offset($offset);

        return $this;
    }





    /**
     * @inheritDoc
    */
    public function getQuery(): QueryInterface
    {
        return new Query($this->em, $this, $this->mappedClass);
    }
}
