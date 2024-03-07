<?php
declare(strict_types=1);

namespace Laventure\Component\Database\ORM\Persistence\Repository;

use Laventure\Component\Database\ORM\Persistence\Manager\EntityManagerInterface;
use Laventure\Component\Database\ORM\Persistence\Mapping\Metadata\ClassMetadataInterface;

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
    )
    {
    }





    /**
     * @inheritDoc
    */
    public function find($id): mixed
    {

    }





    /**
     * @inheritDoc
    */
    public function findOneBy(array $criteria, array $orderBy = []): mixed
    {

    }




    /**
     * @inheritDoc
    */
    public function findAll(): array
    {

    }



    /**
     * @inheritDoc
    */
    public function findBy(
        array $criteria,
        array $orderBy = [],
        int $limit = null,
        int $offset = null
    ): mixed
    {

    }



    /**
     * @inheritDoc
    */
    public function getClassName(): string
    {
       return $this->metadata->getName();
    }
}
