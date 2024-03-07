<?php
declare(strict_types=1);

namespace Laventure\Component\Database\ORM\Persistence\Query\Builder\SQL\Traits;


use Laventure\Component\Database\ORM\Persistence\Manager\EntityManagerInterface;
use Laventure\Component\Database\ORM\Persistence\Query\Query;
use Laventure\Component\Database\ORM\Persistence\Query\QueryInterface;
use Laventure\Component\Database\Query\Builder\SQL\Criteria\CriteriaInterface;
use Laventure\Component\Database\Query\Builder\SQL\Expr\ExpressionBuilderInterface;
use Laventure\Component\Database\Query\Builder\SQL\SQLBuilderInterface;

/**
 * BuilderTrait
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\ORM\Persistence\Query\Builder\Traits
 */
trait BuilderTrait
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
    public function __construct(EntityManagerInterface $em, SQLBuilderInterface $builder)
    {
        $this->em      = $em;
        $this->builder = $builder;
    }





    /**
     * @return string
     */
    public function getSQL(): string
    {
       return $this->builder->getSQL();
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
        $this->setParameter($id, $value);

        return $this;
    }




    /**
     * @param $id
     * @return mixed
    */
    public function getParameter($id): mixed
    {
        return $this->getParameter($id);
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
     * @return QueryInterface
    */
    public function getQuery(): QueryInterface
    {
        return new Query();
    }





    /**
     * @return ExpressionBuilderInterface
    */
    public function expr(): ExpressionBuilderInterface
    {

    }




    /**
     * @return CriteriaInterface
    */
    public function getCriteria(): CriteriaInterface
    {

    }


    /**
     * @return void
    */
    public function __toString()
    {

    }
}