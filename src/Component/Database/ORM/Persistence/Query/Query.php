<?php
declare(strict_types=1);

namespace Laventure\Component\Database\ORM\Persistence\Query;

use Laventure\Component\Database\ORM\Persistence\Manager\EntityManagerInterface;
use Laventure\Component\Database\ORM\Persistence\Query\Builder\SQL\BuilderInterface;
use Laventure\Component\Database\Query\Result\QueryResultInterface;

/**
 * Query
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\ORM\Query
*/
class Query implements QueryInterface
{

    /**
     * @param EntityManagerInterface $em
     * @param BuilderInterface $builder
    */
    public function __construct(
        protected EntityManagerInterface $em,
        protected BuilderInterface $builder
    )
    {
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
    public function getParameters(): array
    {
        return $this->builder->getParameters();
    }






    /**
     * @inheritDoc
    */
    public function execute($fetchMode = null): mixed
    {
         $statement =  $this->em->createNativeQuery(
             $this->getSQL(),
             $this->getParameters()
         );

         if (!$fetchMode) {
             return $statement->execute();
         }

         return $statement->fetch()->all($fetchMode);
    }





    /**
     * @inheritDoc
    */
    public function fetch(): QueryResultInterface
    {

    }



    /**
     * @inheritDoc
    */
    public function fetchAll(): array
    {
        return [];
    }




    /**
     * @inheritDoc
    */
    public function fetchOne(): ?object
    {
        return null;
    }



    /**
     * @inheritDoc
    */
    public function fetchArray(): array
    {
        return [];
    }



    /**
     * @inheritDoc
    */
    public function fetchColumns(): array
    {
        return [];
    }
}
