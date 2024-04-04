<?php
declare(strict_types=1);

namespace Laventure\Component\Database\ORM\Manager\Query;

use Laventure\Component\Database\ORM\Manager\Contract\EntityManagerInterface;
use Laventure\Component\Database\Query\Builder\QueryBuilderInterface;
use Laventure\Component\Database\Query\Builder\SQL\Criteria\CriteriaInterface;
use Laventure\Component\Database\Query\Builder\SQL\Expr\ExpressionBuilderInterface;
use Laventure\Component\Database\Query\QueryInterface;

/**
 * QueryBuilder
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\ORM\Data\Statement
*/
class QueryBuilder implements QueryBuilderInterface
{


    /**
     * @var EntityManagerInterface
    */
    protected EntityManagerInterface $em;


    /**
     * @var QueryBuilderInterface
    */
    protected QueryBuilderInterface $qb;




    /**
     * @param EntityManagerInterface $em
    */
    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
        $this->qb = $em->getConnection()->createQueryBuilder();
    }





    /**
     * @inheritDoc
    */
    public function expr(): ExpressionBuilderInterface
    {
       return $this->qb->expr();
    }




    /**
     * @inheritDoc
    */
    public function select($columns = null): static
    {
        $this->qb->select($columns);

        return $this;
    }




    /**
     * @inheritDoc
    */
    public function distinct(): static
    {
       $this->qb->distinct();

       return $this;
    }




    /**
     * @inheritDoc
    */
    public function addSelect($selects): static
    {
         $this->qb->addSelect($selects);

         return $this;
    }




    /**
     * @inheritDoc
    */
    public function from(string $from, string $alias = ''): static
    {
        if ($this->hasClassname($from)) {
            $class = $this->em->getClassMetadata($from);
            $from  = $class->getTableName();
            $alias = $alias ?: $class->getTableAlias();
            $this->map($class->getName());
        }

        $this->qb->from($from, $alias);

        return $this;
    }




    /**
     * @inheritDoc
    */
    public function map(string $classname): static
    {
        $this->qb->map($classname);

        return $this;
    }




    /**
     * @inheritDoc
    */
    public function join(string $table, string $condition): static
    {
        $this->qb->join($table, $condition);

        return $this;
    }




    /**
     * @inheritDoc
    */
    public function leftJoin(string $table, string $condition): static
    {
        $this->qb->leftJoin($table, $condition);

        return $this;
    }




    /**
     * @inheritDoc
    */
    public function rightJoin(string $table, string $condition): static
    {
        $this->qb->rightJoin($table, $condition);

        return $this;
    }




    /**
     * @inheritDoc
    */
    public function innerJoin(string $table, string $condition): static
    {
        $this->qb->innerJoin($table, $condition);

        return $this;
    }




    /**
     * @inheritDoc
    */
    public function fullJoin(string $table, string $condition): static
    {
        $this->qb->fullJoin($table, $condition);

        return $this;
    }




    /**
     * @inheritDoc
    */
    public function addJoin(string $join): static
    {
        $this->qb->addJoin($join);

        return $this;
    }





    /**
     * @inheritDoc
    */
    public function groupBy(string $columns): static
    {
        $this->qb->groupBy($columns);

        return $this;
    }




    /**
     * @inheritDoc
    */
    public function addGroupBy(string $columns): static
    {
        $this->qb->addGroupBy($columns);

        return $this;
    }




    /**
     * @inheritDoc
    */
    public function addHaving(string $condition, $type = null): static
    {
         $this->qb->addHaving($condition, $type);

         return $this;
    }




    /**
     * @inheritDoc
    */
    public function having(string $condition): static
    {
         $this->qb->having($condition);

         return $this;
    }




    /**
     * @inheritDoc
    */
    public function andHaving(string $condition): static
    {
        $this->qb->andHaving($condition);

        return $this;
    }




    /**
     * @inheritDoc
    */
    public function orHaving(string $condition): static
    {
        $this->qb->orHaving($condition);

        return $this;
    }




    /**
     * @inheritDoc
    */
    public function orderBy(string $column, string $direction = null): static
    {
         $this->qb->orderBy($column, $direction);

         return $this;
    }




    /**
     * @inheritDoc
    */
    public function addOrderBy(array $orders): static
    {
        $this->qb->addOrderBy($orders);

        return $this;
    }




    /**
     * @inheritDoc
    */
    public function limit($limit): static
    {
         $this->qb->limit($limit);

         return $this;
    }




    /**
     * @inheritDoc
    */
    public function offset($offset): static
    {
         $this->qb->offset($offset);

         return $this;
    }




    /**
     * @inheritDoc
    */
    public function insert(string $table): static
    {
         $this->qb->insert($table);

         return $this;
    }





    /**
     * @inheritDoc
    */
    public function values(array $values): static
    {
        $this->qb->values($values);

        return $this;
    }





    /**
     * @inheritDoc
    */
    public function setValue(string $column, $value, int $index = 0): static
    {
        $this->qb->setValue($column, $value, $index);

        return $this;
    }




    /**
     * @inheritDoc
    */
    public function update(string $table): static
    {
        $this->qb->update($table);

        return $this;
    }




    /**
     * @inheritDoc
    */
    public function set($column, $value): static
    {
        $this->qb->set($column, $value);

        return $this;
    }




    /**
     * @inheritDoc
    */
    public function delete($table): static
    {
        $this->qb->delete($table);

        return $this;
    }




    /**
     * @inheritDoc
    */
    public function criteria(array $criteria): static
    {
        $this->qb->criteria($criteria);

        return $this;
    }




    /**
     * @inheritDoc
    */
    public function where($condition): static
    {
        $this->qb->where($condition);

        return $this;
    }




    /**
     * @inheritDoc
    */
    public function whereIn($column, array $value): static
    {
         $this->qb->whereIn($column, $value);

         return $this;
    }




    /**
     * @inheritDoc
    */
    public function whereEqualTo($column, $value): static
    {
         $this->qb->whereEqualTo($column, $value);

         return $this;
    }




    /**
     * @inheritDoc
    */
    public function andWhere($condition): static
    {
        $this->qb->andWhere($condition);

        return $this;
    }




    /**
     * @inheritDoc
    */
    public function orWhere($condition): static
    {
        $this->qb->orWhere($condition);

        return $this;
    }




    /**
     * @inheritDoc
    */
    public function setParameters(array $parameters): static
    {
        $this->qb->setParameters($parameters);

        return $this;
    }




    /**
     * @inheritDoc
    */
    public function setParameter($id, $value): static
    {
         $this->qb->setParameter($id, $value);

         return $this;
    }




    /**
     * @inheritDoc
    */
    public function getCriteria(): CriteriaInterface
    {
        return $this->qb->getCriteria();
    }




    /**
     * @inheritDoc
    */
    public function getSQL(): string
    {
        return $this->qb->getSQL();
    }




    /**
     * @inheritDoc
    */
    public function getQuery(): QueryInterface
    {
        return new Statement($this->em, $this->qb->getQuery());
    }




    /**
     * @param string $from
     * @return bool
    */
    public function hasClassname(string $from): bool
    {
        return class_exists($from);
    }
}