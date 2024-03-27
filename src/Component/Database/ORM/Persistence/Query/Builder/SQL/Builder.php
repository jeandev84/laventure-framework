<?php

declare(strict_types=1);

namespace Laventure\Component\Database\ORM\Persistence\Query\Builder\SQL;

use Laventure\Component\Database\ORM\Persistence\Manager\Contract\EntityManagerInterface;
use Laventure\Component\Database\ORM\Persistence\Query\Query;
use Laventure\Component\Database\ORM\Persistence\Query\QueryInterface;
use Laventure\Component\Database\Query\Builder\SQL\Criteria\CriteriaInterface;
use Laventure\Component\Database\Query\Builder\SQL\Expr\ExpressionBuilderInterface;
use Laventure\Component\Database\Query\Builder\SQL\SQLBuilderInterface;

/**
 * Builder
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\ORM\DataMapper\Query\Builder\SQL
*/
abstract class Builder implements BuilderInterface
{
    /**
     * @var EntityManagerInterface
     */
    protected EntityManagerInterface $em;




    /**
     * @var SQLBuilderInterface
    */
    protected $builder;





    /**
     * @param EntityManagerInterface $em
     * @param SQLBuilderInterface $builder
     */
    public function __construct(
        EntityManagerInterface $em,
        SQLBuilderInterface $builder
    ) {
        $this->em      = $em;
        $this->builder = $builder;
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
    public function getQuery(): QueryInterface
    {
        return new Query($this->em, $this);
    }




    /**
     * @inheritDoc
     */
    public function expr(): ExpressionBuilderInterface
    {
        return $this->builder->expr();
    }




    /**
     * @return CriteriaInterface
     */
    public function getCriteria(): CriteriaInterface
    {
        return $this->builder->getCriteria();
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





    /**
     * @return string
    */
    public function __toString(): string
    {
        return $this->getSQL();
    }






    /**
     * @param string $classname
     * @return string
    */
    protected function getTableNameFromClass(string $classname): string
    {
        return $this->em->getUnitOfWork()
                        ->getPersistent($classname)
                        ->getTableName();
    }






    /**
     * @param string $classname
     * @return bool
    */
    protected function hasMappedClass(string $classname): bool
    {
        return class_exists($classname);
    }
}
