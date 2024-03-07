<?php

declare(strict_types=1);

namespace Laventure\Component\Database\ORM\Persistence;

use Laventure\Component\Database\ORM\Persistence\Manager\Contract\EntityManagerInterface;
use Laventure\Component\Database\ORM\Persistence\Mapper\Identity\IdentityMap;
use Laventure\Component\Database\ORM\Persistence\Mapper\Identity\IdentityMapperInterface;
use Laventure\Component\Database\ORM\Persistence\Mapping\Metadata\ClassMetadataInterface;
use Laventure\Component\Database\ORM\Persistence\Query\Builder\QueryBuilderInterface;
use Laventure\Component\Database\ORM\Persistence\Query\Builder\SQL\DQL\Select\Select;

/**
 * Persistent
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\ORM\Persistence
 */
class Persistent implements PersistentInterface
{
    /**
     * @var EntityManagerInterface
    */
    protected EntityManagerInterface $em;




    /**
     * @var ClassMetadataInterface
    */
    protected ClassMetadataInterface $classMetadata;





    /**
     * @var IdentityMapperInterface
    */
    protected IdentityMapperInterface $identityMap;




    /**
     * @var array
    */
    protected array $insert = [];



    /**
     * @var array
    */
    protected array $inserted = [];




    /**
     * @var array
    */
    protected array $update = [];




    /**
     * @var array
    */
    protected array $updated = [];





    /**
     * @var array
    */
    protected array $delete = [];





    /**
     * @var array
    */
    protected array $deleted = [];





    /**
     * @param EntityManagerInterface $em
     * @param $entity
    */
    public function __construct(
        EntityManagerInterface $em,
        $entity
    ) {
        $this->em            = $em;
        $this->classMetadata = $em->getClassMetadata($entity);
        $this->identityMap   = new IdentityMap();
    }




    /**
     * @inheritDoc
    */
    public function find($id): mixed
    {
        $identityId = $this->getIdentityId($id);

        if ($this->identityMap->has($identityId)) {
            return $this->identityMap->get($identityId);
        }

        $data = $this->findOneBy([$this->getIdentifier() => $id]);
        $this->identityMap->map($identityId, $data);
        return $data;
    }






    /**
     * Find object by criteria
     *
     * @param array $criteria
     * @return mixed
    */
    public function findOneBy(array $criteria): mixed
    {
        return $this->select()
                    ->from($this->getClassName(), $this->getTableAlias())
                    ->criteria($criteria)
                    ->getQuery()
                    ->fetchOne();
    }





    /**
     * @param string|null $columns
     * @return Select
    */
    public function select(string $columns = null): Select
    {
        return $this->createQueryBuilder()
                    ->select($columns)
                    ->from($this->getClassName(), $this->getTableAlias());
    }







    /**
     * @inheritDoc
    */
    public function addInsert(array $attributes): static
    {
        $this->insert[$this->getClassName()][] = $attributes;

        return $this;
    }





    /**
     * @inheritDoc
    */
    public function insert(): int
    {

    }




    /**
     * @inheritDoc
    */
    public function addUpdate($id, array $attributes): static
    {

    }




    /**
     * @inheritDoc
    */
    public function update(): mixed
    {

    }




    /**
     * @inheritDoc
    */
    public function addDelete($id): static
    {

    }




    /**
     * @inheritDoc
    */
    public function delete(): mixed
    {
        return null;
    }




    /**
     * @inheritDoc
    */
    public function createQueryBuilder(): QueryBuilderInterface
    {
        return $this->em->createQueryBuilder();
    }




    /**
     * @inheritDoc
    */
    public function getIdentityMap(): IdentityMapperInterface
    {
        return $this->identityMap;
    }





    /**
     * @inheritDoc
    */
    public function getClassMetadata(): ClassMetadataInterface
    {
        return $this->classMetadata;
    }




    /**
     * @inheritDoc
    */
    public function getClassName(): string
    {
        return $this->classMetadata->getName();
    }




    /**
     * @inheritDoc
    */
    public function getTableName(): string
    {
        return '';
    }





    /**
     * @return string
    */
    public function getTableAlias(): string
    {
        return strtoupper($this->getClassName());
    }





    /**
     * @param $id
     * @return string
    */
    public function getIdentityId($id): string
    {
        return $this->identityMap->getIdentityId($this->getClassName(), $id);
    }





    /**
     * @return string
    */
    public function getIdentifier(): string
    {
        return $this->classMetadata->getIdentifier();
    }
}
