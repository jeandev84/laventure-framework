<?php
declare(strict_types=1);

namespace Laventure\Component\Database\ORM\Persistence\Repository;

use Laventure\Component\Database\ORM\Persistence\Manager\Contract\EntityManagerInterface;
use Laventure\Component\Database\ORM\Persistence\Mapping\Metadata\ClassMetadataInterface;
use Laventure\Component\Database\ORM\Persistence\PersistentInterface;
use Laventure\Component\Database\ORM\Persistence\Query\Builder\SQL\DQL\Select\Select;
use Laventure\Component\Database\ORM\Persistence\Repository\Contract\EntityRepositoryInterface;

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
     * @return Select
    */
    public function createQueryBuilder(string $alias): Select
    {
        return $this->em->createQueryBuilder()
                        ->select()
                        ->from($this->getClassName(), $alias);
    }






    /**
     * @inheritDoc
    */
    public function find($id): mixed
    {
        return $this->em->find($this->getClassName(), $id);
    }





    /**
     * @inheritDoc
    */
    public function findOneBy(array $criteria, array $orderBy = []): mixed
    {
        return $this->createQueryBuilder($this->getAlias())
                    ->criteria($criteria)
                    ->addOrderBy($orderBy)
                    ->getQuery()
                    ->fetchOne();
    }





    /**
     * @inheritDoc
    */
    public function findAll(): array
    {
        return $this->createQueryBuilder($this->getAlias())
                    ->getQuery()
                    ->fetchAll();
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
        return $this->createQueryBuilder($this->getAlias())
                    ->criteria($criteria)
                    ->addOrderBy($orderBy)
                    ->limit($limit)
                    ->offset($offset)
                    ->getQuery()
                    ->fetchAll();
    }



    /**
     * @inheritDoc
    */
    public function getClassName(): string
    {
        return $this->metadata->getName();
    }





    /**
     * @return PersistentInterface
    */
    private function getPersistent(): PersistentInterface
    {
        return $this->em->getUnitOfWork()
                        ->getPersistent($this->getClassName());
    }





    /**
     * @return string
    */
    private function getAlias(): string
    {
        return $this->getPersistent()->getTableAlias();
    }
}
