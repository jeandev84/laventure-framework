<?php

declare(strict_types=1);

namespace Laventure\Component\Database\ORM\Persistence\UnitOfWork;

use Laventure\Component\Database\ORM\Persistence\Manager\EntityManagerInterface;
use Laventure\Component\Database\ORM\Persistence\Manager\Event\EventManagerInterface;
use Laventure\Component\Database\ORM\Persistence\Mapper\Data\DataMapper;
use Laventure\Component\Database\ORM\Persistence\Mapper\Data\DataMapperInterface;
use Laventure\Component\Database\ORM\Persistence\Mapping\Metadata\ClassMetadata;
use Laventure\Component\Database\ORM\Persistence\Mapping\Metadata\Factory\ClassMetadataFactoryInterface;
use Laventure\Component\Database\ORM\Persistence\Persistent;
use Laventure\Component\Database\ORM\Persistence\PersistentInterface;
use Laventure\Component\Database\ORM\Persistence\Storage\ObjectStorage;
use ReflectionException;

/**
 * UnitOfWork
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\ORM\UnitOfWork
*/
class UnitOfWork implements UnitOfWorkInterface
{
    public const STATE_MANAGED   = 1;
    public const STATE_NEW       = 2;
    public const STATE_DETACHED  = 3;
    public const STATE_REMOVED   = 4;




    /**
     * @var EntityManagerInterface
    */
    protected EntityManagerInterface $em;




    /**
     * @var ObjectStorage
    */
    protected ObjectStorage $storage;




    /**
     * @var EventManagerInterface
    */
    protected EventManagerInterface $eventManager;




    /**
     * @var ClassMetadataFactoryInterface
    */
    protected ClassMetadataFactoryInterface $metadataFactory;



    /**
     * @var DataMapperInterface
    */
    protected DataMapperInterface $dataMapper;




    /**
     * @param EntityManagerInterface $em
    */
    public function __construct(EntityManagerInterface $em)
    {
        $this->em           = $em;
        $this->eventManager = $em->getEventManager();
        $this->dataMapper   = new DataMapper();
        $this->storage      = new ObjectStorage();
    }






    /**
     * @inheritDoc
    */
    public function find(int $id): ?object
    {
        return $this->storage[$id] ?? null;
    }





    /**
     * @inheritDoc
    */
    public function persist(object $object): static
    {
        $this->addPersistState($object);

        return $this;
    }




    /**
     * @inheritDoc
    */
    public function remove(object $object): static
    {

    }




    /**
     * @inheritDoc
    */
    public function refresh(object $object): static
    {

    }




    /**
     * @inheritDoc
    */
    public function attach(object $object): static
    {
        $this->storage->attach($object);

        return $this;
    }




    /**
     * @inheritDoc
    */
    public function detach(object $object): static
    {
        $this->storage->detach($object);

        return $this;
    }




    /**
     * @inheritDoc
    */
    public function merge(object $object): static
    {
        return $this->attach($object);
    }




    /**
     * @inheritDoc
    */
    public function contains(object $object): bool
    {
        return $this->storage->contains($object);
    }





    /**
     * @inheritDoc
     * @throws ReflectionException
    */
    public function isNew(object $object): bool
    {
        $metadata = new ClassMetadata($object);
        return $metadata->isNew();
    }





    /**
     * @inheritDoc
    */
    public function commit(): static
    {

    }





    /**
     * Clear storage
     *
     * @return void
    */
    public function clear(): void
    {
        $this->storage->clear();
    }





    /**
     * @inheritDoc
    */
    public function getPersistent($class): PersistentInterface
    {
        return new Persistent($this->em, $class);
    }






    /**
     * @inheritdoc
     */
    public function addState(object $object, $state): static
    {
        $this->storage->attach($object, $state);

        return $this;
    }





    /**
     * @param object $object
     * @return $this
    */
    public function addPersistState(object $object): static
    {
        return $this;
    }





    /**
     * @inheritDoc
    */
    public function addNewState(object $object): static
    {
        return $this;
    }




    /**
     * @inheritDoc
    */
    public function addManagedState(object $object): static
    {
        return $this;
    }





    /**
     * @inheritDoc
    */
    public function addDetachedState(object $object): static
    {
        return $this;
    }






    /**
     * @inheritDoc
    */
    public function addRemovedState(object $object): static
    {
        return $this;
    }
}
