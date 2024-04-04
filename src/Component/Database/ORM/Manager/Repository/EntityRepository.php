<?php

declare(strict_types=1);

namespace Laventure\Component\Database\ORM\Manager\Repository;

use Laventure\Component\Database\ORM\Manager\Contract\EntityManagerInterface;
use Laventure\Component\Database\ORM\Mapping\ClassMetadataInterface;
use Laventure\Component\Database\ORM\Repository\Contract\EntityRepositoryInterface;
use Laventure\Component\Database\Query\Builder\QueryBuilderInterface;


/**
 * EntityRepository
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\ORM\Repository
*/
class EntityRepository implements EntityRepositoryInterface
{
    /**
     * @param EntityManagerInterface $em
     * @param ClassMetadataInterface $metadata
    */
    public function __construct(
        protected EntityManagerInterface $em,
        protected ClassMetadataInterface $metadata
    ) {
    }







    /**
     * @param string $alias
     * @return QueryBuilderInterface
    */
    public function createQueryBuilder(string $alias): QueryBuilderInterface
    {
        return $this->em->createQueryBuilder()
                        ->select()
                        ->from($this->getClassName(), $alias);
    }




    /**
     * @return QueryBuilderInterface
    */
    public function createNativeQueryBuilder(): QueryBuilderInterface
    {
        return $this->createQueryBuilder($this->getAlias());
    }





    /**
     * @inheritDoc
    */
    public function find($id, $lockMode = null, $lockVersion = null): mixed
    {
        return $this->em->find($this->getClassName(), $id);
    }





    /**
     * @inheritDoc
    */
    public function findOneBy(array $criteria, array $orderBy = []): mixed
    {
        return $this->createNativeQueryBuilder()
                    ->criteria($criteria)
                    ->addOrderBy($orderBy)
                    ->getQuery()
                    ->fetch()
                    ->one();
    }





    /**
     * @inheritDoc
    */
    public function findAll(): array
    {
        return $this->createNativeQueryBuilder()
                    ->getQuery()
                    ->fetch()
                    ->all();
    }





    /**
     * @inheritDoc
    */
    public function findBy(
        array $criteria,
        array $orderBy = [],
        int $limit = null,
        int $offset = null
    ): array {
        return $this->createNativeQueryBuilder()
                    ->criteria($criteria)
                    ->addOrderBy($orderBy)
                    ->limit($limit)
                    ->offset($offset)
                    ->getQuery()
                    ->fetch()
                    ->all();
    }



    /**
     * @inheritDoc
    */
    public function getClassName(): string
    {
        return $this->metadata->getName();
    }





    /**
     * @return string
    */
    protected function getAlias(): string
    {
        return $this->metadata->getTableAlias();
    }
}
