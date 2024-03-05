<?php
declare(strict_types=1);

namespace Laventure\Component\Database\Query\Builder\SQL\Decorator;


use Laventure\Component\Database\Connection\ConnectionInterface;
use Laventure\Component\Database\Query\Builder\SQL\Criteria\CriteriaInterface;
use Laventure\Component\Database\Query\Builder\SQL\Expr\ExpressionBuilderInterface;
use Laventure\Component\Database\Query\Builder\SQL\SQLBuilder;
use Laventure\Component\Database\Query\Builder\SQL\SQLBuilderInterface;
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
    */
    public function __construct($builder)
    {
        $this->builder = $builder;
    }






    /**
     * @inheritDoc
    */
    public function setParameters(array $parameters): static
    {
        $this->builder->setParameters($parameters);

        return $this;
    }






    /**
     * @inheritDoc
    */
    public function setParameter($id, $value): static
    {
        $this->builder->setParameter($id, $value);

        return $this;
    }




    /**
     * @inheritDoc
    */
    public function getParameter($id): mixed
    {
        return $this->builder->getParameter($id);
    }




    /**
     * @inheritDoc
    */
    public function getParameters(): array
    {
        return $this->builder->getParameters();
    }




    /**
     * @inheritDoc
    */
    public function bindParam($id, $value, int $type = 0): static
    {
        $this->builder->bindParam($id, $value, $type);

        return $this;
    }






    /**
     * @inheritDoc
    */
    public function bindValue($id, $value, int $type = 0): static
    {
        $this->builder->bindValue($id, $value, $type);

        return $this;
    }




    /**
     * @inheritDoc
    */
    public function bindColumn($id, $value, int $type = 0): static
    {
        $this->builder->bindColumn($id, $value, $type);

        return $this;
    }





    /**
     * @inheritDoc
    */
    public function getSQL(): string
    {
        return $this->builder->getSQL();
    }





    /**
     * @inheritDoc
    */
    public function __toString()
    {
        return $this->getSQL();
    }




    /**
     * @inheritDoc
    */
    public function expr(): ExpressionBuilderInterface
    {
        return $this->builder->expr();
    }





    /**
     * @inheritDoc
    */
    public function getConnection(): ConnectionInterface
    {
        return $this->builder->getConnection();
    }





    /**
     * @inheritDoc
    */
    public function getQuery(): QueryInterface
    {
        return $this->builder->getQuery();
    }




    /**
     * @inheritDoc
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
        return $this->getBuilder()->getWheres();
    }
}