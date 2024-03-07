<?php
declare(strict_types=1);

namespace Laventure\Component\Database\ORM\Persistence;

use Laventure\Component\Database\ORM\Persistence\Manager\EntityManagerInterface;
use Laventure\Component\Database\ORM\Persistence\Mapping\Metadata\ClassMetadataInterface;
use Laventure\Component\Database\ORM\Persistence\Query\Builder\QueryBuilderInterface;

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
     * @var array
    */
    protected array $identityMap = [];




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
    )
    {
        $this->em = $em;
        $this->classMetadata = $em->getClassMetadata($entity);
    }




    /**
     * @inheritDoc
    */
    public function find($id): mixed
    {
        if (isset($this->identityMap[$id])) {
            return $this->identityMap[$id];
        }

        return $this->identityMap["{$this->getClassName()}.{$id}"] = $id;
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
}