<?php
declare(strict_types=1);

namespace Laventure\Component\Database\Query\Builder\SQL\Decorator;


use Laventure\Component\Database\Connection\ConnectionInterface;
use Laventure\Component\Database\Query\Builder\SQL\Criteria\CriteriaInterface;
use Laventure\Component\Database\Query\Builder\SQL\Expr\ExpressionBuilderInterface;
use Laventure\Component\Database\Query\Builder\SQL\SQLBuilder;
use Laventure\Component\Database\Query\QueryInterface;

/**
 * SQLBuilderDecoratorTrait
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\Query\Builder\SQL\Decorator
*/
trait SQLBuilderDecoratorTrait
{
    /**
     * @var SQLBuilder
     */
    protected $builder;




    /**
     * @param $builder
     * @return mixed
   */
    public function withBuilder($builder): static
    {
        $this->builder = $builder;

        return $this;
    }





    /**
     * @param array $parameters
     * @return $this
    */
    public function setParameters(array $parameters): static
    {
        $this->builder->setParameters($parameters);

        return $this;
    }





    /**
     * @param $id
     * @param $value
     * @return $this
    */
    public function setParameter($id, $value): static
    {
        $this->builder->setParameter($id, $value);

        return $this;
    }





    /**
     * @param $id
     * @return mixed
    */
    public function getParameter($id): mixed
    {
        return $this->builder->getParameter($id);
    }





    /**
     * @return array
    */
    public function getParameters(): array
    {
        return $this->builder->getParameters();
    }





    /**
     * @param $id
     * @param $value
     * @param int $type
     * @return $this
    */
    public function bindParam($id, $value, int $type = 0): static
    {
        $this->builder->bindParam($id, $value, $type);

        return $this;
    }





    /**
     * @param $id
     * @param $value
     * @param int $type
     * @return $this
    */
    public function bindValue($id, $value, int $type = 0): static
    {
        $this->builder->bindValue($id, $value, $type);

        return $this;
    }





    /**
     * @param $id
     * @param $value
     * @param int $type
     * @return $this
    */
    public function bindColumn($id, $value, int $type = 0): static
    {
        $this->builder->bindColumn($id, $value, $type);

        return $this;
    }





    /**
     * @return string
    */
    public function getSQL(): string
    {
        return $this->builder->getSQL();
    }





    /**
     * @return string
    */
    public function __toString()
    {
        return $this->getSQL();
    }





    /**
     * @return ExpressionBuilderInterface
    */
    public function expr(): ExpressionBuilderInterface
    {
        return $this->builder->expr();
    }





    /**
     * @return ConnectionInterface
    */
    public function getConnection(): ConnectionInterface
    {
        return $this->builder->getConnection();
    }





    /**
     * @return QueryInterface
    */
    public function getQuery(): QueryInterface
    {
        return $this->builder->getQuery();
    }




    /**
     * @return CriteriaInterface
    */
    public function getCriteria(): CriteriaInterface
    {
        return $this->builder->getCriteria();
    }





    /**
     * @param $column
     * @param $value
     * @return $this
    */
    public function set($column, $value): static
    {
        $this->builder->set($column, $value);

        return $this;
    }





    /**
     * @param $condition
     * @return $this
    */
    public function where($condition): static
    {
        $this->builder->where($condition);

        return $this;
    }






    /**
     * @param $column
     * @param array $value
     * @return $this
    */
    public function whereIn($column, array $value): static
    {
        $this->builder->whereIn($column, $value);

        return $this;
    }





    /**
     * @param $column
     * @param $value
     * @return $this
    */
    public function whereEqualTo($column, $value): static
    {
        $this->builder->whereEqualTo($column, $value);

        return $this;
    }





    /**
     * @param $condition
     * @return $this
    */
    public function andWhere($condition): static
    {
        $this->builder->andWhere($condition);

        return $this;
    }





    /**
     * @param $condition
     * @return $this
    */
    public function orWhere($condition): static
    {
        $this->builder->orWhere($condition);

        return $this;
    }




    /**
     * @param $condition
     * @param $type
     * @return $this
    */
    public function addWhere($condition, $type = null): static
    {
        $this->builder->addWhere($condition, $type);

        return $this;
    }





    /**
     * @param array $conditions
     * @return $this
    */
    public function criteria(array $conditions): static
    {
        foreach ($conditions as $column => $value) {
            if (is_array($value)) {
                $this->whereIn($column, $value);
            } else {
                $this->whereEqualTo($column, $value);
            }
        }

        return $this;
    }





    /**
     * @return array
    */
    public function getWheres(): array
    {
        return $this->builder->getWheres();
    }




    /**
     * @return array
    */
    public function getBindingParams(): array
    {
        return $this->builder->getBindingParams();
    }


    /**
     * @return array
    */
    public function getBindingValues(): array
    {
        return $this->builder->getBindingValues();
    }




    /**
     * @return array
    */
    public function getBindingColumns(): array
    {
        return $this->builder->getBindingColumns();
    }
}